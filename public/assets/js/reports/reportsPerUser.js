document.getElementById("form").addEventListener("submit", function (event) {
    event.preventDefault();
    
    const formData = new FormData(this);
    const url = this.getAttribute("action");

    fetch(url, {
        method: "POST",
        body: formData,
    })
    .then((response) => response.json())
    .then((data) => {
        console.log("Respuesta recibida:", data);
        
        if (data.status === "success") {

            // 🔥 Actualizar tabla y total general con los nuevos datos 🔥
            actualizarTablaReporte(data.data);
            
            let total = data.data.reduce((acc, venta) => acc + parseFloat(venta.total_venta), 0);
            actualizarTotalGeneral(total, data);
        } else {
            console.error("Error al obtener datos:", data.message || "Respuesta incorrecta");
        }
    })
    .catch((error) => console.error("Error en la petición:", error));
});




document.addEventListener("DOMContentLoaded", function () {
  cargarReporte();
});

function cargarReporte() {
  fetch("../business_logic/general_logic_report.php")
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        actualizarTablaReporte(data.ventas);
        actualizarTotalGeneral(data.total);
        alert(data)
      } else {
        console.error("Error al obtener datos:", data.message);
      }
    })
    .catch((error) => console.error("Error en la petición:", error));
    
}



function actualizarTablaReporte(ventas) {
  const tbody = document.getElementById("tablaReporte");
  tbody.innerHTML = ""; // Limpiar contenido previo

  ventas.forEach((venta) => {
      const row = document.createElement("tr");
      row.innerHTML = `
          <td>${venta.fecha_hora}</td>
          <td>${venta.id_venta}</td>
          <td>${venta.nombre_vendedor}</td>
          <td>${venta.clave_fragancias}</td>
          <td>${venta.envace_fragancias}</td>
          <td>${venta.gramos_fragancia}</td>
          <td>${venta.total_gramos}</td>
          <td>$${Number(venta.total_venta).toLocaleString('es-ES', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>

      `;
      tbody.appendChild(row);
  });
}

function actualizarTotalGeneral(total, data) {
  document.getElementById("totalGeneral").textContent = `$${Number(total).toLocaleString('es-ES', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
  document.getElementById("startDate").textContent = data.fecha_inicio || "N/A";
  document.getElementById("endDate").textContent = data.fecha_fin || "N/A";
}

console.log(document.getElementById("startDate")); // ¿Devuelve null?
console.log(document.getElementById("endDate")); // ¿Devuelve null?
