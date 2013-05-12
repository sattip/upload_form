function setPaymentInfo(isChecked)
{
	with (window.document.frmCheckout) {
		if (isChecked) {
			txtPaymentFirstName.value  = txtShippingFirstName.value;
			txtPaymentLastName.value   = txtShippingLastName.value;
			txtPaymentAddress1.value   = txtShippingAddress1.value;
			txtPaymentAddress2.value   = txtShippingAddress2.value;
			txtPaymentPhone.value      = txtShippingPhone.value;
			txtPaymentState.value      = txtShippingState.value;			
			txtPaymentCity.value       = txtShippingCity.value;
			txtPaymentPostalCode.value = txtShippingPostalCode.value;
			
			txtPaymentFirstName.readOnly  = true;
			txtPaymentLastName.readOnly   = true;
			txtPaymentAddress1.readOnly   = true;
			txtPaymentAddress2.readOnly   = true;
			txtPaymentPhone.readOnly      = true;
			txtPaymentState.readOnly      = true;			
			txtPaymentCity.readOnly       = true;
			txtPaymentPostalCode.readOnly = true;			
		} else {
			txtPaymentFirstName.readOnly  = false;
			txtPaymentLastName.readOnly   = false;
			txtPaymentAddress1.readOnly   = false;
			txtPaymentAddress2.readOnly   = false;
			txtPaymentPhone.readOnly      = false;
			txtPaymentState.readOnly      = false;			
			txtPaymentCity.readOnly       = false;
			txtPaymentPostalCode.readOnly = false;			
		}
	}
}


function checkShippingAndPaymentInfo()
{
	with (window.document.frmCheckout) {
		if (isEmpty(txtShippingFirstName, 'Enter first name')) {
			return false;
		} else if (isEmpty(txtShippingLastName, 'Enter last name')) {
			return false;
		} else if (isEmpty(txtShippingAddress1, 'Enter shipping address')) {
			return false;
		} else if (isEmpty(txtShippingPhone, 'Enter phone number')) {
			return false;
		} else if (isEmpty(txtShippingState, 'Enter shipping address state')) {
			return false;
		} else if (isEmpty(txtShippingCity, 'Enter shipping address city')) {
			return false;
		} else if (isEmpty(txtShippingPostalCode, 'Enter the shipping address postal/zip code')) {
			return false;
		} else if (isEmpty(txtPaymentFirstName, 'Enter first name')) {
			return false;
		} else if (isEmpty(txtPaymentLastName, 'Enter last name')) {
			return false;
		} else if (isEmpty(txtPaymentAddress1, 'Enter Payment address')) {
			return false;
		} else if (isEmpty(txtPaymentPhone, 'Enter phone number')) {
			return false;
		} else if (isEmpty(txtPaymentState, 'Enter Payment address state')) {
			return false;
		} else if (isEmpty(txtPaymentCity, 'Enter Payment address city')) {
			return false;
		} else if (isEmpty(txtPaymentPostalCode, 'Enter the Payment address postal/zip code')) {
			return false;
		} else {
			return true;
		}
	}
}
