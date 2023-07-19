(()=>{

    const toastAlerts = [
        {alert: "toast-info", background: "bg-info"},
        {alert: "toast-error", background: "bg-danger"},
        {alert: "toast-warning", background: "bg-warning"},
        {alert: "toast-primary", background: "bg-primary"},
        {alert: "toast-success", background: "bg-success"},
    ];


    toastAlerts.forEach(item => {
        const toast = document.querySelector('.'+item.alert);
        if(toast){
            if(!toast.classList.contains(item.background))
                  toast.classList.add(item.background);
        }
    })

  })();
