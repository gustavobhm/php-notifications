$(function() {

 $("#i-export_image").click(function(event) {

  html2canvas(document.getElementById("p-notification")).then(function(canvas) {

   let crm = document.getElementById("b-crm").innerHTML;
   let dataURL = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");

   downloadImage(dataURL, 'notificação_' + crm + '.png');

  });

 });

 $("#i-export_pdf").click(function(event) {

  html2canvas(document.getElementById("p-notification"), {
    scale: "3"
  }).then(function(canvas) {
	  
   let w = document.getElementById("p-notification").offsetWidth;
   let h = document.getElementById("p-notification").offsetHeight;

   let crm = document.getElementById("b-crm").innerHTML;

   let img = canvas.toDataURL("image/jpeg").replace("image/png", "image/octet-stream");
   let doc = new jsPDF('p', 'px', 'a4');

   doc.addImage(img, 'JPEG', 80, 100, (w / 1.79), (h / 1.79));
   doc.save('notificação_' + crm + '.pdf');

  });

 });

});

function downloadImage(data, filename = 'untitled.jpeg') {
 var a = document.createElement('a');
 a.href = data;
 a.download = filename;
 document.body.appendChild(a);
 a.click();
}