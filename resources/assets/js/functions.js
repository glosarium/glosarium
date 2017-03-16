/**
 * jQuery handler
 */
$(() => {
	$('a.logout').click(() => {
		$('#logout-form').submit();
		return false;
	});
});