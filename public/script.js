document.addEventListener("DOMContentLoaded", (event) => {
  const modal = document.getElementById("cart-modal");
  const btn = document.getElementById("open-cart");
  const span = document.getElementsByClassName("close")[0];

  btn.onclick = function () {
    modal.style.display = "block";
  };

  span.onclick = function () {
    modal.style.display = "none";
  };

  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  };
});

document
  .getElementById("finalizar-compra")
  .addEventListener("click", function () {
    alert("EN PROCESO");
  });
  