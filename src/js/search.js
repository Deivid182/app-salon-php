document.addEventListener("DOMContentLoaded", () => {
  initSearch();
});

const initSearch = () => {
  searchByDate();
}

const searchByDate = () => {
  const input = document.querySelector("#date");
  input.addEventListener("input", (e) => {
    const selectedDate = e.target.value;
    console.log(selectedDate);
    window.location = `?date=${selectedDate}`
  })
}