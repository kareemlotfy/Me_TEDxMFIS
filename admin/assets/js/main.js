window.isRtl = window.Helpers.isRtl(), window.isDarkStyle = window.Helpers.isDarkStyle();
let menu, animate, isHorizontalLayout = !1;
document.getElementById("layout-menu") && (isHorizontalLayout = document.getElementById("layout-menu").classList.contains("menu-horizontal")),
    function () {
        setTimeout(function () {
            window.Helpers.initCustomOptionCheck()
        }, 1e3), document.querySelectorAll("#layout-menu").forEach(function (e) {
            menu = new Menu(e, {
                orientation: isHorizontalLayout ? "horizontal" : "vertical",
                closeChildren: !!isHorizontalLayout,
                showDropdownOnHover: localStorage.getItem("templateCustomizer-" + templateName + "--ShowDropdownOnHover") ? "true" === localStorage.getItem("templateCustomizer-" + templateName + "--ShowDropdownOnHover") : void 0 === window.templateCustomizer || window.templateCustomizer.settings.defaultShowDropdownOnHover
            }), window.Helpers.scrollToActive(animate = !1), window.Helpers.mainMenu = menu
        });
        document.querySelectorAll(".layout-menu-toggle").forEach(e => {
            e.addEventListener("click", e => {
                if (e.preventDefault(), window.Helpers.toggleCollapsed(), config.enableMenuLocalStorage && !window.Helpers.isSmallScreen()) try {
                    localStorage.setItem("templateCustomizer-" + templateName + "--LayoutCollapsed", String(window.Helpers.isCollapsed()));
                    var t, o = document.querySelector(".template-customizer-layouts-options");
                    o && (t = window.Helpers.isCollapsed() ? "collapsed" : "expanded", o.querySelector(`input[value="${t}"]`).click())
                } catch (e) {}
            })
        });
        if (document.getElementById("layout-menu")) {
            var t = document.getElementById("layout-menu");
            var o = function () {
                Helpers.isSmallScreen() || document.querySelector(".layout-menu-toggle").classList.add("d-block")
            };
            let e = null;
            t.onmouseenter = function () {
                e = Helpers.isSmallScreen() ? setTimeout(o, 0) : setTimeout(o, 300)
            }, t.onmouseleave = function () {
                document.querySelector(".layout-menu-toggle").classList.remove("d-block"), clearTimeout(e)
            }
        }
        window.Helpers.swipeIn(".drag-target", function (e) {
            window.Helpers.setCollapsed(!1)
        }), window.Helpers.swipeOut("#layout-menu", function (e) {
            window.Helpers.isSmallScreen() && window.Helpers.setCollapsed(!0)
        });
        let e = document.getElementsByClassName("menu-inner"),
            n = document.getElementsByClassName("menu-inner-shadow")[0];
        0 < e.length && n && e[0].addEventListener("ps-scroll-y", function () {
            this.querySelector(".ps__thumb-y").offsetTop ? n.style.display = "block" : n.style.display = "none"
        });
    }



    function closePopup() {
        let popup = document.getElementById("popup");
        let newUsername = document.getElementById("new_username");
        popup.classList.add("close_popup");
        document.body.classList.remove("popup_active");
        newUsername.focus();
    }

    function addBodyClassAndStyle() {
        let popup = document.getElementById("popup");
        popup.classList.remove("close_popup");
        document.body.classList.add("popup_active");
    }

    function showPermissions(adminId) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'admin/Permissions/permissions.php?admin_id=' + adminId, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById('permissionsSection').innerHTML = xhr.responseText;
            } else if (xhr.readyState == 4) {
                document.getElementById('permissionsSection').innerHTML =
                    "An error occurred while loading permissions.";
            }
        };
        xhr.send();
    }

    function confirmDelete(adminId) {
        if (confirm("Are you sure you want to delete this admin?")) {
            deleteAdmin(adminId);
        }
    }

    function deleteAdmin(adminId) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'admin/Permissions/DeleteAdminScript.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                alert(xhr.responseText); // Show alert message from server
                location.reload(); // Refresh the page after deletion
            } else if (xhr.readyState == 4) {
                alert("Error deleting admin.");
            }
        };
        xhr.send('admin_id=' + adminId);
    }