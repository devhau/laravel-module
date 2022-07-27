
let initModal = () => {
    window.initLivewireModal = true;
    window.addEventListener('closemodal', event => {
        const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById(`${event.detail.id}Modal`));
        modal?.hide();
    });
    window.addEventListener('refreshData', event => {
        if (event.detail.module) {
            Livewire.emit('refreshData' + event.detail.module);
        }
    });
    const debounce = (func, wait, immediate) => {
        var timeout
        return function () {
            var context = this,
                args = arguments
            var later = function () {
                timeout = null
                if (!immediate) func.apply(context, args)
            }
            var callNow = immediate && !timeout
            clearTimeout(timeout)
            timeout = setTimeout(later, wait)
            if (callNow) func.apply(context, args)
        }
    }
    const debounceIf = (condition, callback, time) => {
        return condition ? debounce(callback, time) : callback
    }

    Livewire.components.registerDirective('showmodal', function (el, directive, component) {
        const elModal = document.getElementById(`${component.id}Modal`);
        const modal = bootstrap.Modal.getOrCreateInstance(elModal);
        const handler = e => {
            component.callAfterModelDebounce(() => {
                directive.setEventContext(e)
                // This is outside the conditional below so "wire:click.prevent" without 
                // a value still prevents default.
                if (document.querySelectorAll('.modal').length > 1) {
                    document.querySelectorAll('.modal')[document.querySelectorAll('.modal').length - 2]?.setAttribute('style', 'display:block;');
                } else {
                    document.querySelector('.modal')?.setAttribute('style', 'display:block;');
                }

                const method = directive.method
                let params = directive.params

                if (
                    params.length === 0 &&
                    e instanceof CustomEvent &&
                    e.detail
                ) {
                    params.push(e.detail)
                }
                // Check for global event emission.
                if (method === '$emit') {
                    component.scopedListeners.call(...params)
                    Livewire.components.emit(...params)
                    return
                }

                if (method === '$emitUp') {
                    Livewire.components.emitUp(el, ...params)
                    return
                }

                if (method === '$emitSelf') {
                    Livewire.components.emitSelf(component.id, ...params)
                    return
                }

                if (method === '$emitTo') {
                    Livewire.components.emitTo(...params)
                    return
                }
                modal.hide();
                Livewire.emit('closeModal', component.id);
                setTimeout(() => {
                    if (document.querySelectorAll('.modal').length > 1) {
                        if (!document.body.classList.contains('modal-open')) {
                            document.body.classList.add('modal-open');
                            document.body.setAttribute('style', 'overflow: hidden; padding-right: 16px;');
                        }
                    }
                })
            });

            return;

        }
        const hasDebounceModifier = directive.modifiers.includes('debounce')
        const debouncedHandler = debounceIf(
            hasDebounceModifier,
            handler,
            directive.durationOr(150)
        )
        if (modal) {
            document.querySelectorAll('.modal').forEach((item) => {
                if (item != elModal) {
                    item.setAttribute('style', 'z-index:1050;display:block;');
                }
            });
            modal.show();
            elModal.addEventListener('hidden.bs.modal', debouncedHandler)
        }
        component.addListenerForTeardown(() => {
            elModal.removeEventListener('hidden.bs.modal', debouncedHandler)
        })
    });
    Livewire.components.registerDirective('hidemodal', function (el, directive, component) {
        const event = 'click';
        const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById(`${component.id}Modal`));
        const handler = e => {
            component.callAfterModelDebounce(() => {
                directive.setEventContext(e)

                // This is outside the conditional below so "wire:click.prevent" without
                // a value still prevents default.

                const method = directive.method
                let params = directive.params
                modal.hide();

                if (
                    params.length === 0 &&
                    e instanceof CustomEvent &&
                    e.detail
                ) {
                    params.push(e.detail)
                }
                // Check for global event emission.
                if (method === '$emit') {
                    component.scopedListeners.call(...params)
                    Livewire.components.emit(...params)
                    return
                }

                if (method === '$emitUp') {
                    Livewire.components.emitUp(el, ...params)
                    return
                }

                if (method === '$emitSelf') {
                    Livewire.components.emitSelf(component.id, ...params)
                    return
                }

                if (method === '$emitTo') {
                    Livewire.components.emitTo(...params)
                    return
                }
            });

            return;

        }
        const hasDebounceModifier = directive.modifiers.includes('debounce')
        const debouncedHandler = debounceIf(
            hasDebounceModifier,
            handler,
            directive.durationOr(150)
        )

        el.addEventListener(event, debouncedHandler)

        component.addListenerForTeardown(() => {
            el.removeEventListener(event, debouncedHandler)
        })
    });

    Livewire.components.registerDirective('openmodal', function (el, directive, component) {
        const event = 'click';
        const handler = e => {
            component.callAfterModelDebounce(() => {
                directive.setEventContext(e)

                // This is outside the conditional below so "wire:click.prevent" without
                // a value still prevents default.

                const method = directive.method
                let params = directive.params
                Livewire.emit('openModal', method, params);
            });

            return;

        }
        const hasDebounceModifier = directive.modifiers.includes('debounce')
        const debouncedHandler = debounceIf(
            hasDebounceModifier,
            handler,
            directive.durationOr(150)
        )

        el.addEventListener(event, debouncedHandler)

        component.addListenerForTeardown(() => {
            el.removeEventListener(event, debouncedHandler)
        })
    });
}

let loadModalWithoutLivewire = () => {
    document.querySelectorAll('[wire\\:openmodal]').forEach((item) => {
        if (item.closest('[wire\\:id]') || item.getAttribute('openmodal') == 'true') return;
        item.setAttribute('openmodal', 'true');
        item.addEventListener('click', () => {
            let method = item.getAttribute('wire:openmodal');
            let params = []
            const methodAndParamString = method.match(/(.*?)\((.*)\)/s)

            if (methodAndParamString) {
                method = methodAndParamString[1];
                // Use a function that returns it's arguments to parse and eval all params
                // This "$event" is for use inside the livewire event handler.
                let func = new Function('$event', `return (function () {
                        for (var l=arguments.length, p=new Array(l), k=0; k<l; k++) {
                            p[k] = arguments[k];
                        }
                        return [].concat(p);
                    })(${methodAndParamString[2]})`)

                params = func()
            }
            Livewire.emit('openModal', method, params);
        });
    })
};
document.addEventListener('DOMContentLoaded', () => {
    document.addEventListener("devhau:turbo", function (event) {
        loadModalWithoutLivewire();
    });
    loadModalWithoutLivewire();
});
if (!window.initLivewireModal)
    initModal();