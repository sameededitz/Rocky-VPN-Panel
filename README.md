# Rocky VPN Admin Panel

**Rocky VPN Admin Panel** is a powerful management system designed to handle VPS servers, execute commands remotely, monitor VPN server connections, and track usage statistics. It includes advanced features to ensure seamless VPN and VPS server management.

---

## Features

### 🖥 **VPS Server Management**
- **Add/Edit/Delete VPS Servers**: Manage VPS instances efficiently.
- **Execute Commands**: Run terminal commands remotely on VPS servers.
- **Monitor Server Health**: Track CPU, RAM, and disk usage.
- **Live VPS Stats**: View real-time usage and performance metrics.

### 🔗 **VPN Server Management**
- **Deploy VPN Servers on VPS**: Connect VPN servers to specific VPS instances.
- **Manage VPN Configurations**: Control VPN settings and protocols.
- **Monitor VPN Usage**: Track the number of active users on each VPN server.

### 📊 **Real-Time Statistics**
- **Connected Users**: View the number of users connected to each VPN.
- **Data Usage Tracking**: Monitor bandwidth consumption per VPS/VPN.
- **Server Load Balancing**: Optimize VPN distribution across multiple VPS instances.

### 👥 **User Management**
- **Add/Remove Users**: Manage VPN user accounts.
- **Subscription Control**: Activate/deactivate user access based on plan purchases.
- **Usage Logs**: Keep track of user login history and session duration.

### 📜 **Plan & Subscription Management**
- **Create Custom VPN Plans**: Define pricing, duration, and limits.
- **Subscription Handling**: Assign users to VPN plans and track expirations.
- **Affiliate/Referral System**: Manage commissions for referrals.

---

## Installation

### Prerequisites
- PHP 8.2+
- Laravel 11
- MySQL
- Composer
- SSH Access to VPS Servers

### Steps
1. **Clone the repository**:
    ```bash
    git clone https://github.com/sameededitz/Rocky-VPN-Panel.git
    ```
2. **Navigate to the project directory**:
    ```bash
    cd rocky-vpn-admin
    ```
3. **Install dependencies**:
    ```bash
    composer install
    ```
4. **Set up environment variables**:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
5. **Run migrations and seeders**:
    ```bash
    php artisan migrate --seed
    ```
6. **Start the server**:
    ```bash
    php artisan serve
    ```

---

## Usage

### Admin Features
- **Dashboard**: View server stats, user activity, and system logs.
- **VPS Command Execution**: Run Linux commands on VPS servers via the admin panel.
- **VPN Server Management**: Monitor and deploy VPN servers with real-time tracking.
- **User & Subscription Management**: Control user accounts and track VPN subscriptions.

---

## Technologies Used
- **Backend**: Laravel 11
- **Frontend**: Livewire 3, Bootstrap
- **Database**: MySQL
- **Server Communication**: phpseclib for SSH execution

---

## Developer Information
- **Developer**: Sameed
- **Instagram**: [@not_sameed52](https://www.instagram.com/not_sameed52/)
- **Discord**: sameededitz
- **Linktree**: [linktr.ee/sameeddev](https://linktr.ee/sameeddev)
- **Company**: TecClubb
  - **Website**: [https://tecclubx.com/](https://tecclubx.com/)
  - **Contact**: tecclubx@gmail.com

---

## Contributing
Contributions are welcome! Fork the repository, create a new branch, and submit a pull request. Open an issue first for significant changes.

---

## License
This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

## Contact
For inquiries or support, reach out via:
- **Email**: tecclubb@gmail.com
- **Website**: [https://tecclubx.com/](https://tecclubx.com/)