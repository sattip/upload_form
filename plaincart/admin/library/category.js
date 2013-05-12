// JavaScript Document
function checkCategoryForm()
{
    with (window.document.frmCategory) {
		if (isEmpty(txtName, 'Εισάγετε όνομα κατηγορίας')) {
			return;
		} else if (isEmpty(mtxDescription, 'Εισάγετε περιγραφή κατηγορίας')) {
			return;
		} else {
			submit();
		}
	}
}

function addCategory(parentId)
{
	targetUrl = 'index.php?view=add';
	if (parentId != 0) {
		targetUrl += '&parentId=' + parentId;
	}
	
	window.location.href = targetUrl;
}

function modifyCategory(catId)
{
	window.location.href = 'index.php?view=modify&catId=' + catId;
}

function deleteCategory(catId)
{
	if (confirm('Διαγράφοντας την Κατηγορία θα διαγραφούν και όλα τα προϊόντα.\nΕίστε σίγουρος ότι θέλετε να συνεχίσετε;')) {
		window.location.href = 'processCategory.php?action=delete&catId=' + catId;
	}
}

function deleteImage(catId)
{
	if (confirm('Θέλετε σίγουρα να διαγράψετε την εικόνα;')) {
		window.location.href = 'processCategory.php?action=deleteImage&catId=' + catId;
	}
}