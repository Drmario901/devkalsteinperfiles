var jquery;
jQuery(document).ready(function (jq) {
  jquery = jq;
  searchForModels();
});

function searchForModels($ = jquery) {
  // search for current model
  let model = document.querySelector("#woo-meta-model").dataset.model;

  model = model.replace("-A", " (A)");
  model = model.replace("-SS", " (SS)");
  model = model.replace("-S", " (S)");

  // Search for rows labelded as 'Model'
  for (let table of document.querySelectorAll(".p-prev-table>table")) {
    for (let table_header of table.querySelector("tbody").children) {
      if (table_header.innerHTML.includes("Model")) {
        // put in 'current' mark in had'nt

        for (let item of table_header.children) {
          if (item.querySelector("span") != null) {
            item = item.querySelector("span");

            if (item.querySelector("span") != null) {
              item = item.querySelector("span");
            }

            if (item.innerHTML.trim() == model)
              item.innerHTML = `<b style="color: #213280">${item.innerHTML}<br> <small>(current)</small></b>`;
          }
          if (item.querySelector("strong") != null) {
            item = item.querySelector("strong");
            if (item.innerHTML.trim() == model)
              item.innerHTML = `<b style="color: #213280">${item.innerHTML}<br> <small>(current)</small></b>`;
          }
        }

        // add 'a' tag for encountered models
        for (let item of table_header.children) {
          if (item.querySelector("span") != null) {
            item = item.querySelector("span");

            if (item.querySelector("span") != null) {
              item = item.querySelector("span");
            }

            relIfExists(item);
          } else if (item.querySelector("strong") != null) {
            item = item.querySelector("strong");

            relIfExists(item);
          } else if (item.querySelector('b[style="#213280"]') != null) {
          } else {
            relIfExists(item);
          }
        }
      }
    }

    // Search for models in first column
    for (let table_header of document.querySelectorAll(
      ".p-prev-table>table>tbody>tr>td:first-child"
    )) {
      for (let item of table_header.children) {
        if (item.querySelector("span") != null) {
          item = item.querySelector("span");
          relIfExists(item);
        } else if (item.querySelector("strong") != null) {
          item = item.querySelector("strong");
          relIfExists(item);
        } else {
          relIfExists(item);
        }
      }
    }
  }
}

function relIfExists(element, $ = jquery) {
  let content = element.innerHTML;
  $.ajax({
    url: "https://dev.kalstein.plus/wp-content/plugins/kalsteinPerfiles/php/productExists.php",
    method: "POST",
    data: { model: content },
  }).done(function (response) {
    response = JSON.parse(response);
    // console.log(response);

    let slug = content;

    slug = slug.replace(" (A)", "-A");
    slug = slug.replace(" (S)", "-S");
    slug = slug.replace(" (SS)", "-SS");

    if (response.results > 0) {
      element.innerHTML = `<a class='product-table-link' href='https://dev.kalstein.plus/distributor/shop/?search=${slug}'>${content}</a>`;
    }
  });
}
