window.addEventListener("load", function () {
    // Remove Loader
    document.getElementById("load_screen")?.remove();

    // Default Theme Settings
    const defaultSettings = {
        layout: {
            darkMode: false,
            boxed: true,
            logo: {
                dark: '../src/assets/img/logo.svg',
                light: '../src/assets/img/logo2.svg'
            }
        }
    };

    // Load theme from localStorage or use default
    let storedTheme = JSON.parse(localStorage.getItem("theme")) || {};
    storedTheme.layout = storedTheme.layout || defaultSettings.layout;

    // Apply Dark Mode
    document.body.classList.toggle('dark', storedTheme.layout.darkMode);
    document.querySelector('.navbar-logo')?.setAttribute('src', storedTheme.layout.darkMode ? storedTheme.layout.logo.dark : storedTheme.layout.logo.light);

    // Apply Boxed Layout
    document.body.classList.toggle('layout-boxed', storedTheme.layout.boxed);
    document.querySelector('.header-container')?.classList.toggle('container-xxl', storedTheme.layout.boxed);
    document.querySelector('.middle-content')?.classList.toggle('container-xxl', storedTheme.layout.boxed);

    // Save the merged settings back to localStorage
    localStorage.setItem("theme", JSON.stringify(storedTheme));
});