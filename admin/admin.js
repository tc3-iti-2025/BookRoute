function loadTable(categoria) {
  const table = document.getElementById("table");
  if (table) {
    table.innerHTML = "";
    const labels = document.querySelectorAll("span");
    labels.forEach((label) => {
      label.classList.remove("text-gray-900", "dark:text-white");
      label.classList.add("text-gray-500", "dark:text-gray-400");
    });
    const labelElement = document.getElementById(categoria);
    labelElement.classList.add("text-gray-900", "dark:text-white");
    const url = "http://localhost/bookroute/api/controllers/" + categoria + "_controller.php";
    console.log(url);

    fetch(url)
      .then((response) => response.json())
      .then((data) => {
        console.log(data);
        if (data.length > 0) {

          const headers = Object.keys(data[0]);

          console.log(headers);

          const thead = document.createElement("thead");

          const addRow = document.createElement("tr");
          const addCell = document.createElement("th");
          addCell.colSpan = headers.length + 1;
          addCell.className = "px-6 py-3 text-right bg-white dark:bg-gray-800";

          const addButton = document.createElement("button");
          addButton.textContent = "Agregar";
          addButton.className = "bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded text-sm";
          addButton.addEventListener("click", () => {
            console.log("Agregar nuevo registro");
          });

          addCell.appendChild(addButton);
          addRow.appendChild(addCell);
          thead.appendChild(addRow);

          const headerRow = document.createElement("tr");
          headerRow.className = "text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400";

          headers.forEach((headerText) => {
            const th = document.createElement("th");
            th.className = "px-6 py-3";
            th.textContent = headerText;
            headerRow.appendChild(th);
          });

          const actionTh = document.createElement("th");
          actionTh.className = "px-6 py-3";
          actionTh.textContent = "Acciones";
          headerRow.appendChild(actionTh);

          thead.appendChild(headerRow);
          table.appendChild(thead);

          const tbody = document.createElement("tbody");

          data.forEach((item) => {
            const row = document.createElement("tr");
            row.className = "bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600";

            Object.values(item).forEach((value) => {
              const td = document.createElement("td");
              td.className = "px-6 py-4 text-sm text-gray-900 whitespace-nowrap dark:text-white";
              td.textContent = value;
              row.appendChild(td);
            });

            const actionTd = document.createElement("td");
            actionTd.className = "px-6 py-4 flex gap-2";

            const editBtn = document.createElement("button");
            editBtn.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
</svg>

          `;
            editBtn.className = "bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs";
            editBtn.addEventListener("click", () => {
              console.log("Editar", item);
            });

            const deleteBtn = document.createElement("button");
            deleteBtn.innerHTML = `
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
</svg>

            `;
            deleteBtn.className = "bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs";
            deleteBtn.addEventListener("click", () => {
              console.log("Eliminar", item);
            });

            actionTd.appendChild(editBtn);
            actionTd.appendChild(deleteBtn);
            row.appendChild(actionTd);

            tbody.appendChild(row);
          });

          table.appendChild(tbody);
        }
      })
      .catch((error) => {
        console.error("Error fetching data:", error);
      });
  } else {
    console.error("Table element not found");
  }
}
