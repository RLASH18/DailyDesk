document.addEventListener("DOMContentLoaded", function () {
    /*=============== SHOW SIDEBAR ===============*/
    const showSidebar = (toggleId, sidebarId, headerId, mainId) => {
        const toggle = document.getElementById(toggleId),
              sidebar = document.getElementById(sidebarId),
              header = document.getElementById(headerId),
              main = document.getElementById(mainId);

        if (!toggle || !sidebar || !header || !main) {
            console.warn("One or more sidebar elements are missing.");
            return;
        }

        // Apply saved sidebar state
        const isSidebarOpen = localStorage.getItem("sidebar-open") === "true";
        if (isSidebarOpen) {
            sidebar.classList.add("show-sidebar");
            header.classList.add("left-pd");
            main.classList.add("left-pd");
        }

        // Toggle sidebar on button click
        toggle.addEventListener("click", () => {
            const isOpen = sidebar.classList.toggle("show-sidebar");
            header.classList.toggle("left-pd");
            main.classList.toggle("left-pd");
            localStorage.setItem("sidebar-open", isOpen);
        });
    };

    showSidebar("header-toggle", "sidebar", "header", "main");

    /*=============== DASHBOARD LINK ACTIVATION ===============*/
    const sidebarLinks = document.querySelectorAll(".sidebar__list a");
    const dashboardHeaderLink = document.querySelector(".header__logo");
    const dashboardSidebarLink = document.querySelector('.sidebar__list a[href*="dashboard"]');

    // Function to activate a link
    const activateLink = (linkElement) => {
        sidebarLinks.forEach(link => link.classList.remove("active-link"));
        if (linkElement) {
            linkElement.classList.add("active-link");
            localStorage.setItem("activePage", linkElement.href);
        }
    };

    // Activate dashboard when header logo is clicked
    if (dashboardHeaderLink && dashboardSidebarLink) {
        dashboardHeaderLink.addEventListener("click", function() {
            activateLink(dashboardSidebarLink);
        });
    }

    // Activate clicked sidebar links
    sidebarLinks.forEach(link => {
        link.addEventListener("click", function() {
            activateLink(this);
        });
    });

    // Set active link on page load
    const currentURL = window.location.href;
    const activeLink = Array.from(sidebarLinks).find(link => link.href === currentURL);
    
    if (activeLink) {
        activateLink(activeLink);
    } 
    else {
        const storedActivePage = localStorage.getItem("activePage");
        const fallbackLink = Array.from(sidebarLinks).find(link => link.href === storedActivePage);
        activateLink(fallbackLink);
    }

    /*=============== DARK/LIGHT THEME TOGGLE ===============*/ 
    const themeButton = document.getElementById("theme-button");
    const darkTheme = "dark-theme";
    const iconTheme = "ri-sun-fill";

    if (themeButton) {
        // Apply saved theme state
        const selectedTheme = localStorage.getItem("selected-theme");
        const selectedIcon = localStorage.getItem("selected-icon");

        if (selectedTheme === "dark") {
            document.body.classList.add(darkTheme);
        }
        if (selectedIcon === "ri-moon-clear-fill") {
            themeButton.classList.add(iconTheme);
        }

        themeButton.addEventListener("click", () => {
            document.body.classList.toggle(darkTheme);
            themeButton.classList.toggle(iconTheme);
            
            localStorage.setItem("selected-theme", 
                document.body.classList.contains(darkTheme) ? "dark" : "light");
            localStorage.setItem("selected-icon", 
                themeButton.classList.contains(iconTheme) ? "ri-moon-clear-fill" : "ri-sun-fill");
        });
    }
});