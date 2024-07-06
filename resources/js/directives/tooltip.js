Alpine.directive('tooltip', (el, { modifiers, expression }, {cleanup}) => {
    let tooltipText = expression;
    let tooltipPosition = el.dataset.tooltipPosition ? el.dataset.tooltipPosition : 'top';
    let elementPosition = getComputedStyle(el).position;
    if(!['relative', 'absolute', 'fixed'].includes(elementPosition)){
        el.style.position='relative';
    }
    el.classList.add('group');
    let wrapperClass = 'absolute w-auto z-20 text-sm invisible group-hover:visible';
    let arrowWrapClass = 'absolute inline-flex items-center justify-center overflow-hidden';
    let arrowClass = 'w-1.5 h-1.5 transform bg-black bg-opacity-90';
    if(tooltipPosition === 'top'){
        wrapperClass += ' top-0 left-1/2 -translate-x-1/2 -mt-0.5 -translate-y-full';
        arrowWrapClass += ' bottom-0 -translate-x-1/2 left-1/2 w-2.5 translate-y-full';
        arrowClass += ' origin-top-left -rotate-45';
    }else if(tooltipPosition === 'bottom'){
        wrapperClass += ' bottom-0 left-1/2 -translate-x-1/2 -mb-0.5 translate-y-full';
        arrowWrapClass += ' top-0 -translate-x-1/2 left-1/2 w-2.5 -translate-y-full';
        arrowClass += ' origin-bottom-left rotate-45';
    }else if(tooltipPosition === 'left'){
        wrapperClass += ' top-1/2 -translate-y-1/2 -ml-1.5 left-0 -translate-x-full';
        arrowWrapClass += ' right-0 -translate-y-1/2 top-1/2 h-2.5 -mt-px translate-x-full';
        arrowClass += ' origin-top-left rotate-45';
    }else if(tooltipPosition === 'right'){
        wrapperClass += ' top-1/2 -translate-y-1/2 -mr-1.5 right-0 translate-x-full';
        arrowWrapClass += ' left-0 -translate-y-1/2 top-1/2 h-2.5 -mt-px -translate-x-full';
        arrowClass += ' origin-top-right -rotate-45';
    }

    let tooltipHTML = `
                <div data-toggle="tooltip" class="${wrapperClass}">
                    <div class="relative px-2 py-1 text-white bg-black rounded bg-opacity-90">
                        <p class="flex-shrink-0 block text-xs whitespace-nowrap">${tooltipText}</p>
                        <div class="${arrowWrapClass}">
                            <div class="${arrowClass}"></div>
                        </div>
                    </div>
                </div>
            `;
    let mouseEnter = function(event){
        if(el.querySelector('[data-toggle="tooltip"]')){
            return;
        }
        el.innerHTML += tooltipHTML;
    };

    let mouseLeave = function(event){
        el.querySelector('[data-toggle="tooltip"]').remove();
    };

    el.addEventListener('mouseenter', mouseEnter);
    el.addEventListener('mouseleave', mouseLeave);

    cleanup(() => {
        el.removeEventListener('mouseenter', mouseEnter);
        el.removeEventListener('mouseleave', mouseLeave);
    })
})