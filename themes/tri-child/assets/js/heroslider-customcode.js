const drawerTransitioner = transitionHiddenElement({
	  element: document.querySelector('#js-drawer'),
	  visibleClass: 'is-open'
	});

	document.querySelector('.js-open-button').addEventListener('click', () => {
	  drawerTransitioner.show()
	});

	document.querySelector('.js-close-button').addEventListener('click', () => {
	  drawerTransitioner.hide()
	});

function transitionHiddenElement({
  element,
  visibleClass,
  waitMode = 'transitionend',
  timeoutDuration,
  hideMode = 'hidden',
  displayValue = 'block'
}) {
  if (waitMode === 'timeout' && typeof timeoutDuration !== 'number') {
    console.error(`
      When calling transitionHiddenElement with waitMode set to timeout,
      you must pass in a number for timeoutDuration.
    `);

    return;
  }

 
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    waitMode = 'immediate';
  }

 
  const listener = e => {
   
    if (e.target === element) {
      applyHiddenAttributes();

      element.removeEventListener('transitionend', listener);
    }
  };

  const applyHiddenAttributes = () => {
    if(hideMode === 'display') {
      element.style.display = 'none';
    } else {
      element.setAttribute('hidden', true);
    }
  }

  const removeHiddenAttributes = () => {
    if(hideMode === 'display') {
      element.style.display = displayValue;
    } else {
      element.removeAttribute('hidden');
    }
  }

  return {

    show() {
  
      element.removeEventListener('transitionend', listener);

 
      if (this.timeout) {
        clearTimeout(this.timeout);
      }

      removeHiddenAttributes();

   
      const reflow = element.offsetHeight;

      element.classList.add(visibleClass);
    },


    hide() {
      if (waitMode === 'transitionend') {
        element.addEventListener('transitionend', listener);
      } else if (waitMode === 'timeout') {
        this.timeout = setTimeout(() => {
          applyHiddenAttributes();
        }, timeoutDuration);
      } else {
        applyHiddenAttributes();
      }

      element.classList.remove(visibleClass);
    },

 
    toggle() {
      if (this.isHidden()) {
        this.show();
      } else {
        this.hide();
      }
    },

  
    isHidden() {
    
      const hasHiddenAttribute = element.getAttribute('hidden') !== null;

      const isDisplayNone = element.style.display === 'none';

      const hasVisibleClass = [...element.classList].includes(visibleClass);

      return hasHiddenAttribute || isDisplayNone || !hasVisibleClass;
    },

 
    timeout: null
  };
}