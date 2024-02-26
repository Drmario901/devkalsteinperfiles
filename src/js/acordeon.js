jQuery(document).ready(function($){
    $(document).on('click', '.acordeon-subcategory-button', function(e){
        e.preventDefault();

        let list = $(`.acordeon-subcategory-ul-${$(this).attr('value')}`);

        let opened = !(list.attr('hidden') == 'hidden');

        if(!opened){
            list.removeAttr('hidden');
            $(`.acordeon-chevron-${$(this).attr('value')}`).removeClass('fa-chevron-down');
            $(`.acordeon-chevron-${$(this).attr('value')}`).addClass('fa-chevron-up');
        }
        else {
            list.attr('hidden', 'hidden');
            $(`.acordeon-chevron-${$(this).attr('value')}`).removeClass('fa-chevron-up');
            $(`.acordeon-chevron-${$(this).attr('value')}`).addClass('fa-chevron-down');
        }
    })

    $(document).on('click', '.acordeon-line-button', function(e){
        let list = $(`.acordeon-category-ul-${$(this).attr('value')}`);

        let opened = !(list.attr('hidden') == 'hidden');

        if(!opened){
            list.removeAttr('hidden');
            $(`.acordeon-chevron-${$(this).attr('value')}`).removeClass('fa-chevron-down');
            $(`.acordeon-chevron-${$(this).attr('value')}`).addClass('fa-chevron-up');
        }
        else {
            list.attr('hidden', 'hidden');
            $(`.acordeon-chevron-${$(this).attr('value')}`).removeClass('fa-chevron-up');
            $(`.acordeon-chevron-${$(this).attr('value')}`).addClass('fa-chevron-down');
        }
    });
    
});