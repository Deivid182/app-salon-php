let step = 1;
const minStep = 1;
const maxStep = 3;

const appointment = {
  id: "",
  name: "",
  date: "",
  time: "",
  services: [],
};

document.addEventListener("DOMContentLoaded", () => {
  initApp();
});

const initApp = () => {
  showSection();
  tabs();
  onChange();
  onPrev();
  onNext();
  queryApi();
  getUserId();
  getName();
  selectDate();
  selectTime();
  showSummary();
};

const tabs = () => {
  const btns = document.querySelectorAll(".tabs button");
  btns.forEach((btn) => {
    btn.addEventListener("click", (e) => {
      step = parseInt(e.target.dataset.step);
      showSection();
      onChange();
    });
  });
};

const showSection = () => {
  const prevSection = document.querySelector(".show");
  if (prevSection) prevSection.classList.remove("show");
  const section = document.querySelector(`#step-${step}`);
  section.classList.add("show");

  const prevTab = document.querySelector(".active");
  if (prevTab) prevTab.classList.remove("active");

  //highlight the active step
  const tab = document.querySelector(`.tabs button[data-step="${step}"]`);
  tab.classList.add("active");
};

const onChange = () => {
  const next = document.querySelector("#next");
  const prev = document.querySelector("#prev");
  if (step === 1) {
    prev.classList.add("hide");
    next.classList.remove("hide");
  } else if (step === 3) {
    prev.classList.remove("hide");
    next.classList.add("hide");
    showSummary();
  } else {
    prev.classList.remove("hide");
    next.classList.remove("hide");
  }
  showSection();
};

const onPrev = () => {
  const prev = document.querySelector("#prev");
  prev.addEventListener("click", () => {
    if (step <= minStep) return;
    step--;
    onChange();
  });
};

const onNext = () => {
  const next = document.querySelector("#next");
  next.addEventListener("click", () => {
    if (step >= maxStep) return;
    step++;
    onChange();
  });
};

const getUserId = () => {
  appointment.id = document.querySelector("#id").value;
}

const queryApi = async () => {
  try {
    const url = `${location.origin}/api/services`;
    const res = await fetch(url);
    const data = await res.json();
    showServices(data);
  } catch (error) {
    console.log(error);
  }
};

const showServices = (services) => {
  services.forEach((service) => {
    const { name, id, price } = service;
    const nameService = document.createElement("p");
    nameService.classList.add("name-service");
    nameService.textContent = name;

    const priceService = document.createElement("p");
    priceService.classList.add("price-service");
    priceService.textContent = `$${price}`;

    const serviceContainer = document.createElement("div");
    serviceContainer.classList.add("service");
    serviceContainer.dataset.id = id;
    serviceContainer.onclick = () => selectService(service);

    serviceContainer.appendChild(nameService);
    serviceContainer.appendChild(priceService);

    document.querySelector("#services").appendChild(serviceContainer);
  });
};

const selectService = (service) => {
  if (appointment.services.some((item) => item.id === service.id)) {
    appointment.services = appointment.services.filter(
      (item) => item.id !== service.id
    );
    document
      .querySelector(`[data-id="${service.id}"]`)
      .classList.remove("service-selected");
  } else {
    appointment.services = appointment.services.concat(service);
    document
      .querySelector(`[data-id="${service.id}"]`)
      .classList.add("service-selected");
  }
};

const getName = () => {
  appointment.name = document.querySelector("#name").value;
};

const selectDate = () => {
  const inputDate = document.querySelector("#date");
  inputDate.addEventListener("input", (e) => {
    //exclude sunday and saturday
    console.log(e.target.value);
    const date = new Date(e.target.value);
    if ([5, 6].includes(date.getDay())) {
      e.target.value = "";
      appointment.date = "";
      showAlert("Weekends are not available", "error", ".form", 3000);
    } else {
      appointment.date = e.target.value;
    }
    console.log(appointment);
  });
};

const selectTime = () => {
  const prevAlert = document.querySelector(".alert");
  if (prevAlert) prevAlert.remove();
  const inputTime = document.querySelector("#time");
  inputTime.addEventListener("input", (e) => {
    const hour = e.target.value.split(":")[0];
    if (hour < 10 || hour > 18) {
      e.target.value = "";
      appointment.time = "";
      showAlert("We are only open from 10am to 6pm", "error", ".form", 3000);
    } else {
      appointment.time = e.target.value;
    }
  });
};

const showAlert = (message, type, selector, time) => {
  const prevAlert = document.querySelector(".alert");
  if (prevAlert) prevAlert.remove();
  const alert = document.createElement("div");
  alert.textContent = message;
  alert.classList.add("alert", `alert-${type}`);
  document.querySelector(selector).appendChild(alert);
  if (time) {
    setTimeout(() => {
      alert.remove();
    }, time);
  }
};

const showSummary = () => {
  const summary = document.querySelector(".summary");
  while (summary.firstChild) {
    summary.removeChild(summary.firstChild);
  }
  //todo validate when the user deselects a service
  if (
    Object.values(appointment).includes("") ||
    appointment.services.length === 0
  ) {
    showAlert("Fill the form and select a service", "error", ".summary");
    return;
  }
  const { name, date, time, services } = appointment;

  //heading
  const headingServices = document.createElement("h2");
  headingServices.textContent = "Summary of your services";
  summary.appendChild(headingServices);

  services.forEach((service) => {
    const { name, price, id } = service;
    const serviceContainer = document.createElement("div");
    serviceContainer.classList.add("service-summary");
    serviceContainer.innerHTML = `
      <p>${name}</p>
      <p>${price}</p>
    `;
    summary.appendChild(serviceContainer);
  });

  const infoClient = document.createElement("div");
  infoClient.classList.add("info-client");

  const headingClient = document.createElement("h2");
  headingClient.textContent = "Information of the client";
  infoClient.appendChild(headingClient);

  const nameClient = document.createElement("P");
  nameClient.innerHTML = `<span>Name:</span> ${name}`;

  const formattedDate = new Date(date);
  const timezoneOffsetMinutes = formattedDate.getTimezoneOffset();
  const adjustedDate = new Date(
    formattedDate.getTime() + timezoneOffsetMinutes * 60 * 1000
  );
  const options = {
    weekday: "long",
    year: "numeric",
    month: "long",
    day: "numeric",
  };
  const newDate = adjustedDate.toLocaleDateString("en-US", options);

  const dateAppointment = document.createElement("P");
  dateAppointment.innerHTML = `<span>Fecha:</span> ${newDate}`;

  const timeAppointment = document.createElement("P");
  timeAppointment.innerHTML = `<span>Time:</span> ${time} hrs`;

  const btnConfirm = document.createElement("button");
  btnConfirm.classList.add("btn");
  btnConfirm.textContent = "Confirm";
  btnConfirm.onclick = () => confirmAppointment();
  
  infoClient.appendChild(nameClient);
  infoClient.appendChild(dateAppointment);
  infoClient.appendChild(timeAppointment);
  
  summary.appendChild(infoClient);
  summary.appendChild(btnConfirm);
};

const confirmAppointment = async () => {
  const formData = new FormData()
  console.log('confirming')

  const { name, date, time, services, id } = appointment;

  formData.append("userId", id);
  formData.append("name", name);
  formData.append("date", date);
  formData.append("time", time);
  const idServices = services.map((service) => service.id);
  formData.append("services", idServices);
  const url = `${location.origin}/api/appointments`;
  try {
    const res = await fetch(url, {
      method: 'POST',
      body: formData
    })
    if(res.ok) {
      const data = await res.json()
      if(data.result) {
        Swal.fire({
          position: "center",
          icon: "success",
          title: "Appointment created successfully",
          showConfirmButton: true,
        }).then(() => {
          setTimeout(() => {
            location.reload();
          }, 3000);
        })
      }
    } else {
      console.log('something went wrong')
      Swal.fire({
        position: "center",
        icon: "error",
        title: "Something went wrong",
        showConfirmButton: true,
      })
    }
  } catch (error) {
    console.log(error)
    Swal.fire({
      position: "center",
      icon: "error",
      title: "Something went wrong",
      showConfirmButton: true,
    })
  }
}