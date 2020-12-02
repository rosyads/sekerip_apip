$('#qrCodeModal').on('show.bs.modal', function (event) {
    let kd_guru = $(event.relatedTarget).data('kd_guru') 
    $(this).find('.modal-body input[id="kd_guru"]').val(kd_guru)
    generateQR(kd_guru)
  })

  $('#qrCodeModal').on('show.bs.modal', function (event) {
    let nama_guru = $(event.relatedTarget).data('nama_guru') 
    $(this).find('.modal-body input[id="nama_guru"]').val(nama_guru)
  })

  function generateQR(data){
    var kd_guru = data;
    var qrcode = new QRCode(document.getElementById('qrcode'));

    qrcode.makeCode(kd_guru);
    // <button onclick="downloadQR()">download</button>
    var td = document.createElement("button");
    var att1 = document.createAttribute("class");
    var att2 = document.createAttribute("onclick");

    att1.value = "downloadBtn btn btn-primary";
    td.setAttributeNode(att1);
    att2.value = "downloadQR()";
    td.setAttributeNode(att2);
    td.innerText = "Download";
    document.getElementById("qrcode").appendChild(td);

  }

  function downloadQR(){
    var x = document.getElementById("qrcode");
    var y = x.querySelector("img");
    var path = y.getAttribute("src");
    var kodeGuru = document.getElementById("kd_guru").value;
    var namaGuru = document.getElementById("nama_guru").value;
    var filename = kodeGuru + "-" + namaGuru + ".png";

    saveAs(path,filename);

  }