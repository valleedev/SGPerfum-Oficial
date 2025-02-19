// Array para almacenar las fragancias agregadas
let fraganciasInBuy = [];

// Función para guardar el array en el localStorage
function saveFragancias() {
  localStorage.setItem('fraganciasInBuy', JSON.stringify(fraganciasInBuy));
}

// Función para cargar el array desde el localStorage
function loadFragancias() {
  const stored = localStorage.getItem('fraganciasInBuy');
  if (stored) {
    try {
      fraganciasInBuy = JSON.parse(stored);
    } catch (e) {
      fraganciasInBuy = [];
    }
  }
}

// Se carga el array desde el localStorage al iniciar la página
window.addEventListener('load', function(){
  loadFragancias();
  updateSaleDetails();
});

function searchFragancia() {
  let clave = document.getElementById("clave").value.trim();
  let nombre = document.getElementById("nombre").value.trim();

  if (!clave && !nombre) {
    alert("Por favor ingrese un valor para realizar la búsqueda");
    return;
  }

  let url = '../business_logic/perfumes/search_perfume.php';
  if (clave) {
    url += `?clave=${encodeURIComponent(clave)}`;
  } else if (nombre) {
    url += `?nombre=${encodeURIComponent(nombre)}`;
  }

  fetch(url)
    .then(response => {
      if (!response.ok) { 
        console.error("No se encontró la fragancia");
        alert("No se encontró la fragancia");
        return Promise.reject("No se encontró la fragancia");
      }
      return response.json();
    })
    .then(data => {
      console.log("Respuesta JSON recibida:", data); // Para depuración
      if (data && data.data) {
        // Se asume que el JSON trae los campos 'clave_bouquet', 'nombre' e 'imagen'
        addFragranceBuy(data.data.clave_bouquet, data.data.nombre, data.data.imagen);
        updateSaleDetails();
      } else {
        alert("Fragancia no encontrada");
      }
    })
    .catch(error => {
      console.error("Error en la búsqueda:", error);
      alert("Error al buscar la fragancia");
    });
}

function addFragranceBuy(clave, nombre, imagen) {
  fraganciasInBuy.push({ clave, nombre, imagen });
  saveFragancias(); // Guardar en localStorage
}


// Elimina la fragancia del array y actualiza el formulario, además de actualizar el localStorage
function removeFragrance(clave) {
  fraganciasInBuy = fraganciasInBuy.filter(f => f.clave != clave);
  saveFragancias();
  updateSaleDetails();
}

// Genera el formulario dinámico para cada fragancia en el array cargado desde localStorage
function updateSaleDetails() {
  const saleDetails = document.getElementById("saleDetails");
  saleDetails.innerHTML = ""; // Limpiar contenido

  fraganciasInBuy.forEach((fragancia) => {
    // Se crea una tarjeta para cada fragancia
    const card = document.createElement("div");
    card.className = "card mb-2";
    card.innerHTML = `
      <div class="card-body">
        <div class="row align-items-end">
          <!-- Imagen de la fragancia -->
          <div class="col-md-2">
            <img src="../../public/uploads/perfumes/${fragancia.imagen ? fragancia.imagen : 'placeholder.jpg'}" alt="${fragancia.nombre}" class="img-thumbnail" style="max-width: 100px;">
          </div>
          <!-- Muestra nombre y código -->
          <div class="col-md-3">
            <label><strong>Fragancia:</strong> ${fragancia.nombre}</label>
            <p><small>Código: ${fragancia.clave}</small></p>
          </div>
          <!-- Selección del tamaño del envase -->
          <div class="col-md-3">
            <label for="envase_${fragancia.clave}">Tamaño del Envase</label>
            <select id="envase_${fragancia.clave}" name="envase_${fragancia.clave}" class="form-control" onchange="updateSubtotal('${fragancia.clave}')" required>
              <option value="" disabled selected>Seleccione una opción</option>
              <option value="1">30ml</option>
              <option value="2">50ml</option>
              <option value="3">100ml</option>
            </select>
          </div>
          <!-- Ingreso de gramos adicionales -->
          <div class="col-md-2">
            <label for="gramos_${fragancia.clave}">Gramos adicionales</label>
            <input type="number"  id="gramos_${fragancia.clave}" name="gramos_${fragancia.clave}" value="0" class="form-control" onchange="updateSubtotal('${fragancia.clave}')" required>
          </div>
          <!-- Subtotal del artículo -->
          <div class="col-md-2">
            <label>Subtotal</label>
            <input type="text" id="subtotal_${fragancia.clave}" class="form-control" value="0.00" readonly required>
          </div>
        </div>
        <!-- Botón para eliminar la fragancia -->
        <div class="row mt-2">
          <div class="col text-end">
            <button type="button" class="btn btn-link p-0" onclick="removeFragrance('${fragancia.clave}')" title="Eliminar fragancia">
              <small class="text-muted">Eliminar</small>
            </button>
          </div>
        </div>
      </div>
    `;
    saleDetails.appendChild(card);
  });
   updateTotalSale();
}

// Calcula el subtotal para una fragancia basándose en el tamaño y los gramos adicionales.
function updateSubtotal(clave) {
  // Precios base para cada tamaño (ejemplo)
  const basePrices = {
    1: 20000,
    2: 30000,
    3: 50000
  };

    const selectEnvase = document.getElementById(`envase_${clave}`);
    const inputGramos = document.getElementById(`gramos_${clave}`);
    const subtotalField = document.getElementById(`subtotal_${clave}`);

    if (selectEnvase && inputGramos && subtotalField) {
      const envaseSize = selectEnvase.value;
      const basePrice = basePrices[envaseSize] || 0;
      const additionalGrams = parseFloat(inputGramos.value) || 0;
      const pricePerGram = 1500; // Precio por gramo adicional

      const subtotal = basePrice + (additionalGrams * pricePerGram);
      subtotalField.value = subtotal.toFixed(2);
    }

    updateTotalSale();
  }

// Actualiza el total de la venta sumando los subtotales de todas las fragancias
function updateTotalSale() {
  let total = 0;
  fraganciasInBuy.forEach(fragancia => {
    const subtotalField = document.getElementById(`subtotal_${fragancia.clave}`);
    if (subtotalField) {
      total += parseFloat(subtotalField.value) || 0;
    }
  });
  document.getElementById("totalSale").innerText = total.toFixed(2);
}

function prepareSaleData() {
  const saleItems = fraganciasInBuy.map(fragancia => {
    const envaseSelect = document.getElementById(`envase_${fragancia.clave}`);
    const gramosInput = document.getElementById(`gramos_${fragancia.clave}`);
    const subtotalField = document.getElementById(`subtotal_${fragancia.clave}`);
    const envase = envaseSelect ? parseInt(envaseSelect.value) : null;

    let gramos_base = 0;
    switch (envase) {
      case 1: gramos_base = 12; break;
      case 2: gramos_base = 23; break;
      case 3: gramos_base = 38; break;
    }

    const gramos_adicionales = gramosInput ? parseFloat(gramosInput.value) : 0;
    const total_gramos = gramos_base + gramos_adicionales; 

    return {
      clave: fragancia.clave,
      nombre: fragancia.nombre,
      envase: envase,
      gramos_adicionales: gramos_adicionales,
      total_gramos: total_gramos,
      subtotal: subtotalField ? parseFloat(subtotalField.value) : 0
    };
  });

  document.getElementById("sale_data").value = JSON.stringify(saleItems);

  // 🔴 Vaciar el localStorage después de enviar la venta
  localStorage.removeItem('fraganciasInBuy'); 
  fraganciasInBuy = []; 
  updateSaleDetails(); 
}



//------------------------------------------------------
//------------------------------------------------------
//------------------------------------------------------
//------------------------------------------------------
//Ajax para validar las ventas
document.getElementById('saleForm').addEventListener('submit', function(e) {
  e.preventDefault(); // Evitar el envío tradicional del formulario
  
  prepareSaleData(); // Preparar los datos de la venta
  
  const saleData = document.getElementById("sale_data").value;
  
  fetch('../business_logic/perfumes/process_sale.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: saleData
  })
  .then(response => {
    if (!response.ok) {
      throw new Error('Error en la respuesta del servidor');
    }
    return response.json();
  })
  .then(data => {
    if (data.success) {
      alert('Venta procesada correctamente');
      // Limpiar el formulario
      document.getElementById('saleForm').reset();
      localStorage.removeItem('fraganciasInBuy');
      fraganciasInBuy = [];
      updateSaleDetails();
    } else {
      alert('Error en la venta: ' + (data.message || 'Inténtelo nuevamente'));
    }
  })
  .catch(error => {
    console.error('Error en la solicitud:', error);
    alert('Hubo un problema al procesar la venta. Inténtelo de nuevo más tarde.');
  });
});
