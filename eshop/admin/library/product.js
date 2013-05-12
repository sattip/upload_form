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
			alert('Choose the product category');
			cboCategory.focus();
			return;
		} else if (isEmpty(txtName, 'Enter Product name')) {
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
	if (confirm('Delete this product?')) {
		window.location.href = 'processProduct.php?action=deleteProduct&productId=' + productId + '&catId=' + catId;
	}
}

function deleteImage(productId)
{
	if (confirm('Delete this image')) {
		window.location.href = 'processProduct.php?action=deleteImage&productId=' + productId;
	}
}