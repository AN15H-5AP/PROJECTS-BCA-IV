function showcontent(event, contentindex) {
    var i, tabcontent, tablinks;
    //get all elements by class name container
    tabcontent = document.getElementsByClassName("container");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    //get all elements with class tablinks and remove class active
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace("active", "");
    }
    //show the current tab and add an activer class to the links that opended the tab
    document.getElementById(contentindex).style.display = "block";
    event.currentTarget.className += "active";

  }
  document.getElementById("defaultopen").click();

  //function to delete job
  function confirmDelete(jobId) {
    var confirmed = confirm('Are you sure you want to delete?');
    if (confirmed) {
        window.location.href ="jobdelete.php?job_id=" + jobId;
    }
}


//trim image
const image = document.querySelector(".imagesection img");
    // input =document.querySelector("input");

    input.addEventListener("change",() =>{
      const imagename = input.files[0];
      if(imagename){
      image.src = URL.createObjectURL(imagename);
      }
    });