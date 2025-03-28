<?php

namespace App\Livewire\Admin;

use App\Models\VpsServer;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use phpseclib3\Crypt\PublicKeyLoader;
use phpseclib3\Net\SSH2;

class VpsManager extends Component
{
    public VpsServer $server;
    public $command;
    public $output = '';

    public $cpuUsage = 'N/A';
    public $ramUsage = 'N/A';
    public $diskUsage = 'N/A';
    public $isLoading = false;

    public function placeholder()
    {
        return <<<'HTML'
<div class="row layout-top-spacing">
    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 layout-spacing">
        <div class="card" aria-hidden="true">
            <div class="card-body">
                <h5 class="card-title placeholder-glow">
                    <span class="placeholder col-6"></span>
                </h5>
                <p class="card-text placeholder-glow">
                    <span class="placeholder col-7"></span>
                    <span class="placeholder col-4"></span>
                    <span class="placeholder col-4"></span>
                    <span class="placeholder col-6"></span>
                    <span class="placeholder col-8"></span>
                </p>
            </div>
        </div>
    </div>
</div>
HTML;
    }

    public function mount(VpsServer $server)
    {
        $this->server = $server;
    }

    private function connectToServer()
    {
        try {
            $ssh = new SSH2($this->server->ip_address, $this->server->port, 30);

            if (!empty($this->server->private_key)) {
                $key = PublicKeyLoader::load($this->server->private_key);
                if (!$ssh->login($this->server->username, $key)) {
                    throw new \Exception("SSH key authentication failed");
                }
            } else {
                if (!$ssh->login($this->server->username, $this->server->password)) {
                    throw new \Exception("Password authentication failed");
                }
            }

            return $ssh;
        } catch (\Exception $e) {
            Log::error("Error connecting to server: " . $e->getMessage());
            return false;
        }
    }

    public function fetchServerUsage()
    {
        $this->isLoading = true;

        $ssh = $this->connectToServer();

        if (!$ssh) {
            $this->cpuUsage = 'N/A';
            $this->ramUsage = 'N/A';
            $this->diskUsage = 'N/A';
            $this->isLoading = false;
            return;
        }

        try {
            $this->cpuUsage = trim($ssh->exec("top -bn1 | grep 'Cpu' | awk '{print 100 - $8}'")) . "%";
            $this->ramUsage = trim($ssh->exec("free -m | awk 'NR==2{printf \"%s/%s MB (%.2f%%)\", $3,$2,$3*100/$2 }'"));

            $diskUsageRaw = trim($ssh->exec("df -h --output=used,size,pcent / | tail -n 1"));
            list($used, $total, $percent) = preg_split('/\s+/', $diskUsageRaw);
            $this->diskUsage = "$used / $total ($percent)";

            $ssh->disconnect();
        } catch (\Exception $e) {
            Log::error("Error fetching server usage: " . $e->getMessage());
            $this->cpuUsage = 'Error';
            $this->ramUsage = 'Error';
            $this->diskUsage = 'Error';
        } finally {
            $this->isLoading = false;
        }
    }

    public function render()
    {
        $this->fetchServerUsage();
        return view('livewire.admin.vps-manager');
    }
}
