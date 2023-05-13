var comments = {
  // (A) HELPER - AJAX CALL
  ajax : (data, after) => {
    // (A1) DATA TO SEND
    var form = new FormData();
    form.append("id", document.getElementById("pid").value);
    for (let [k,v] of Object.entries(data)) { form.append(k,v); }

    // (A2) AJAX FETCH
    fetch("3-ajax.php", { method: "POST", body: form })
    .then(res => res.text()).then(after)
    .catch(err => console.error(err));
  },

  // (B) LOAD COMMENTS INTO <DIV ID="CWRAP">
  // load : () => comments.ajax({ req : "get" }, data => {
  //   let wrap = document.getElementById("cWrap"), row;
  //   data = JSON.parse(data);
  //   wrap.innerHTML = "";
  //   if (data.length > 0) { for (let c of data) {
  //     row = document.createElement("div");
  //     row.className = "row";
  //     row.innerHTML = `<img class="cImg" src="talk.png">
  //     <div class="cTxt">
  //       <div class="cMsg">${c.message}</div>
  //       <div>
  //         <span class="cName">${c.name}</span>
  //         <span class="cTime">| ${c.timestamp}</span>
  //       </div>
  //     </div>`;
  //     wrap.appendChild(row);
  //   }}
  // }),

  load : () => comments.ajax({ req : "get" }, data => {
    let wrap = document.getElementById("cWrap"), row;
    data = JSON.parse(data);
    wrap.innerHTML = "";
    if (data.length > 0) { for (let c of data) {
      row = document.createElement("div");
      row.className = "pt-2 mt-5";
      row.innerHTML = `
      <div class="d-flex align-items-start py-4 border-bottom"><img class="rounded-circle" src="img/talk.png" width="50" alt="${c.name}">
                    <div class="ps-3">
                      <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="fs-md mb-0">${c.name}</h6>
                      </div>
                      <p class="fs-md mb-1">${c.message}</p><span class="fs-ms text-muted"><i class="ci-time align-middle me-2"></i>| ${c.timestamp}</span>
                    </div>
                  </div>`;
      wrap.appendChild(row);
    }}
  }),



  // (C) ADD COMMENT
  add: () => {
    comments.ajax({
      req : "add",
      name : document.getElementById("cName").value,
      msg : document.getElementById("cMsg").value
    }, res => {
      if (res == "OK") {
        document.getElementById("cAdd").reset();
        comments.load();
      } else { alert(res); }
    });
    return false;
  }
};
window.onload = comments.load;