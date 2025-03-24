Alpine.data('themeSwitch', () => ({
    open: false,
    selectThemeHandler(e){
        let element = e.target;
        if(!element.hasAttribute('data-theme')){
            element = e.target.closest('a')
        }
        this.themeClass = `theme-${element.getAttribute('data-theme')}`;
        localStorage.setItem('theme', this.themeClass);
        this.open = false;
    }
}))