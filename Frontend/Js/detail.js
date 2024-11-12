const sizeoption = document.querySelectorAll(".size-option");

sizeoption.forEach((e) => {
  e.addEventListener("click", () => {
    // Remove 'active__size' class from all elements
    sizeoption.forEach((el) => el.classList.remove("active__size"));

    // Add 'active__size' class to the clicked element
    e.classList.add("active__size");

    // Get size and sizeId attributes of the clicked element
    const size = e.getAttribute("data-size");

    // Update the displayed size in the `.value__size` element
    const value__size = document.querySelector(".value__size");
    const size__value = document.querySelector(".size__value");
    value__size.innerText = size;
    size__value.innerText = size;
  });
});

// color and size options

document.querySelectorAll(".color-option, .size-option").forEach((element) => {
  element.addEventListener("click", () => {
    // Check if the clicked element is a color or size option
    const isColor = element.classList.contains("color-option");

    // Update selected state for the chosen option
    const options = document.querySelectorAll(
      isColor ? ".color-option" : ".size-option"
    );
    options.forEach((el) =>
      el.classList.remove(isColor ? "selected" : "active__size")
    );
    element.classList.add(isColor ? "selected" : "active__size");

    // Get necessary values
    const dataVariationId = document
      .querySelector(".color-option.selected")
      .getAttribute("data-variationId");
    const dataSizeId = document
      .querySelector(".size-option.active__size")
      .getAttribute("data-sizeId");
    const dataProductId = document
      .querySelector(".detail")
      .getAttribute("data-productId");

    //localhost/duan1/?clt=detail&product=2&color=2&size=2
    // Fetch updated data from the server
    http: fetch(
      `http://localhost/duan1/Backend/controller/client/clientAjax.php?product=${dataProductId}&color=${dataVariationId}&size=${dataSizeId}`
    )
      .then((res) => {
        if (!res.ok) {
          throw new Error(`Fetch error: ${res.status}`);
        }
        return res.json();
      })
      .then((data) => {
        console.log("Updated data:", data);

        // Update HTML based on the new data
        document.querySelector(".value__color").innerText = data.color;
        document.querySelector(".value__size").innerText = data.size;
        document.querySelector(
          ".detail__right--price--new"
        ).innerText = `${data.price} đ`;
        document.querySelector(".detail__right--price--old").innerText =
          data.old_price ? `${data.old_price} đ` : "";
      })
      .catch((error) => {
        console.error("Error connecting to server:", error);
      });
  });
});
