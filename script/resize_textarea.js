(textarea = document.getElementById("postText")),
  (hiddenDiv = document.createElement("div")),
  (content = null);

hiddenDiv.classList.add("hiddendiv");
hiddenDiv.classList.add("txtar");

textarea.addEventListener("input", function () {
  this.parentNode.appendChild(hiddenDiv);
  this.style.resize = "none";
  this.style.overflow = "hidden";
  content = this.value;
  hiddenDiv.innerHTML = content + '<br style="line-height: 3px;">';
  hiddenDiv.style.visibility = "hidden";
  hiddenDiv.style.display = "block";
  this.style.height = hiddenDiv.offsetHeight + "px";
  hiddenDiv.style.visibility = "visible";
  hiddenDiv.style.display = "none";
});
