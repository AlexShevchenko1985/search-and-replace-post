const features = () => {

    const form  = document.getElementById('search-form');
    const tBody = document.getElementById('search-tbody');

    const formTitle           = document.getElementById('search-title');
    const formContent         = document.getElementById('search-content');
    const formMetaTitle       = document.getElementById('search-meta-title');
    const formMetaDescription = document.getElementById('search-meta-description');

    formTitle.addEventListener('submit', function(e){
        handleReplace(e, 'input-search-title');
    });
    formContent.addEventListener('submit', function(e){
        handleReplace(e, 'input-search-content');
    });
    formMetaTitle.addEventListener('submit', function(e){
        handleReplace(e, 'input-search-meta-title');
    });
    formMetaDescription.addEventListener('submit', function(e){
        handleReplace(e, 'input-search-meta-description');
    });

    function handleReplace(event, trigger){
        event.preventDefault();

        jQuery.ajax({
            type: 'post',
            url: ajaxurl,
            data: {
                action: 'handleReplace',
                value: document.getElementById(trigger).value,
                oldValue: document.getElementById('search-input').value,
                trigger: trigger,
                ids: tBody.getAttribute('data-ids')

            },
            success: function success(data) {

                if(data.content){
                    tBody.innerHTML = data.content;
                }

            }
        });
    }





    form.addEventListener('submit', function(e){
        handle(e);
    });

    function handle(event){
        event.preventDefault();

        jQuery.ajax({
            type: 'post',
            url: ajaxurl,
            data: {
                action: 'handle',
                value: document.getElementById('search-input').value

            },
            success: function success(data) {

                    if(data.ids){
                        tBody.setAttribute('data-ids', data.ids.toString());
                    }

                    if(data.content){
                        tBody.innerHTML = data.content;
                    }

            }
        });
    }

};

export default features;