$(function(){
    $('#content').addClass('block-section line-bottom');
    $('select.version').change(function(){
    	if ($(this).val() != '') {
    		window.location = _.replace(routes.pageApiIndex, '{version?}', $(this).val());
    	}
    })
});

hljs.initHighlightingOnLoad();