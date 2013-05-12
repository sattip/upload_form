// JavaScript Document
function checkAddUserForm()
{
	with (window.document.frmAddUser) {
		if (isEmpty(txtUserName, 'Είσάγετε όνομα χρήστη')) {
			return;
		} else if (isEmpty(txtPassword, 'Εισάγετε κωδικό')) {
			return;
		} else {
			submit();
		}
	}
}

function addUser()
{
	window.location.href = 'index.php?view=add';
}

function changePassword(userId)
{
	window.location.href = 'index.php?view=modify&userId=' + userId;
}

function deleteUser(userId)
{
	if (confirm('Delete this user?')) {
		window.location.href = 'processUser.php?action=delete&userId=' + userId;
	}
}

