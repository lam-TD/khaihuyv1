export function sweetalert(type, text) {
    switch(type) {
        case 0:
            $.toast({
                heading: 'Warning',
                text: text,
                showHideTransition: 'slide',
                icon: 'warning',
                position: 'top-right'
            })
            break;
        case 1:
            $.toast({
                heading: 'Success',
                text: text,
                showHideTransition: 'slide',
                icon: 'success',
                position: 'top-right'
            })
            break;
        case 3:
            $.toast({
                heading: 'Error',
                text: text,
                showHideTransition: 'slide',
                icon: 'error',
                position: 'top-right'
            })
            break;
    }
}