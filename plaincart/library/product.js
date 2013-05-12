// JavaScript Document
function viewProduct()
{
	with (window.document.frmListProduct) {
		if (cboCategory.selectedIndex == 0) {
			window.location.href = 'index.php';
		} else {
			window.location.href = 'index.php?catId=' + cboCategory.options[cboCategory.selectedIndex].value;
		}
	}
}

function checkAddProductForm()
{
	with (window.document.frmAddProduct) {
		if (cboCategory.selectedIndex == 0) {
			alert('Επιλέξτε κατηγορία');
			cboCategory.focus();
			return;
		} else if (isEmpty(txtName, 'Εισάγετε όνομα προϊόντος')) {
			return;
		} else {
			submit();
		}
	}
}

function addProduct(catId)
{
	window.location.href = 'index.php?view=add&catId=' + catId;
}

function modifyProduct(productId)
{
	window.location.href = 'index.php?view=modify&productId=' + productId;
}

function deleteProduct(productId, catId)
{
	if (confirm('Ειστε σίγουρος ότι θέλετε να διαγράψετε το προϊόν;')) {
		window.location.href = 'processProduct.php?action=deleteProduct&productId=' + productId + '&catId=' + catId;
	}
}

function deleteImage(productId)
{
	if (confirm('Ειστε σίγουρος ότι θέλετε να διαγράψετε την εικόνα;')) {
		window.location.href = 'processProduct.php?action=deleteImage&productId=' + productId;
	}
}