window.mdc.autoInit();
const drawer = document.querySelector('.mdc-drawer').MDCDrawer;
const topAppBar = document.querySelector('.mdc-top-app-bar').MDCTopAppBar;
topAppBar.listen('MDCTopAppBar:nav', () => {
  drawer.open = !drawer.open;
});