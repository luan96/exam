var image = {
  handleFiles: function(files)
  {
    show_image.innerHTML = "";
    for (var i = 0; i < files.length; i++) {
      var img = document.createElement("img");
      img.src = window.URL.createObjectURL(files[i]);
      img.height = 50;
      img.onload = function () {
        window.URL.revokeObjectURL(this.src);
      }
      show_image.appendChild(img);
    }
  }
}