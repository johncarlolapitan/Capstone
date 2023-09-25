const inputs = document.querySelectorAll(".input");


function addcl(){
	let parent = this.parentNode.parentNode;
	parent.classList.add("focus");
}

function remcl(){
	let parent = this.parentNode.parentNode;
	if(this.value == ""){
		parent.classList.remove("focus");
	}
}

function showPass() 
{
	var x = document.getElementById("myInput");
	var y = document.getElementById("hide1");
	var z = document.getElementById("hide2");

	if (x.type === 'password') 
	{
		x.type = "text";
		y.style.display = "block";
		z.style.display = "none";
	}
	else
	{
		x.type = "password";
		y.style.display = "none";
		z.style.display = "block";
	}

}

inputs.forEach(input => {
	input.addEventListener("focus", addcl);
	input.addEventListener("blur", remcl);
});
