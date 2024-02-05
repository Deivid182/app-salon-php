let step = 1;
const minStep = 1;
const maxStep = 3;

const appointment = {
  name: "",
  date: "",
  time: "",
  services: [],
}

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
  } else {
    prev.classList.remove("hide");
    next.classList.remove("hide");
  }
  showSection();
};

const onPrev = () => {
  console.log("onPrev");
  const prev = document.querySelector("#prev");
  prev.addEventListener("click", () => {
    if (step <= minStep) return;
    step--;
    onChange();
  });
};

const onNext = () => {
  console.log("onNext");
  const next = document.querySelector("#next");
  next.addEventListener("click", () => {
    if (step >= maxStep) return;
    step++;
    onChange();
  });
};

const queryApi = async () => {
  try {
    const url = 'http://localhost:3000/api/services';
    const res = await fetch(url);
    const data = await res.json();
    showServices(data)
  } catch (error) {
    console.log(error);
  }
}

const showServices = (services) => {
  services.forEach((service) => {
    const { name, id, price } = service
    const nameService = document.createElement('p');
    nameService.classList.add('name-service');
    nameService.textContent = name;

    const priceService = document.createElement('p');
    priceService.classList.add('price-service');
    priceService.textContent = `$${price}`;

    const serviceContainer = document.createElement('div');
    serviceContainer.classList.add('service');
    serviceContainer.dataset.id = id;
    serviceContainer.onclick = () => selectService(service);

    serviceContainer.appendChild(nameService);
    serviceContainer.appendChild(priceService);

    document.querySelector('#services').appendChild(serviceContainer);
  })
}

const selectService = (service) => {
  if(appointment.services.some(item => item.id === service.id)) {
    appointment.services = appointment.services.filter(item => item.id !== service.id)
    document.querySelector(`[data-id="${service.id}"]`).classList.remove('service-selected')
  } else {
    appointment.services = appointment.services.concat(service)
    document.querySelector(`[data-id="${service.id}"]`).classList.add('service-selected')
  }
}

const getName = () => {
  appointment.name = document.querySelector('#name').value;
}

const selectDate = () => {
  const inputDate = document.querySelector('#date');
  inputDate.addEventListener('input', (e) => {
    //exclude sunday and saturday
    const date = new Date(e.target.value);
    if([5, 6].includes(date.getDay())) {
      e.target.value = '';
      showAlert('Weekends are not available', 'error');
    } else {
      appointment.date = e.target.value;
    }
  })
}

const selectTime = () => {
  const prevAlert = document.querySelector('.alert');
  if(prevAlert) prevAlert.remove();
  const inputTime = document.querySelector('#time');
  inputTime.addEventListener('input', (e) => {
    const hour = e.target.value.split(':')[0];
    if(hour < 10 || hour > 18) {
      e.target.value = '';
      showAlert('We are only open from 10am to 6pm', 'error');
    } else {
      appointment.time = e.target.value;
    }
  })
}

const showAlert = (message, type) => {
  const prevAlert = document.querySelector('.alert');
  if(prevAlert) prevAlert.remove();
  const alert = document.createElement('div')
  alert.textContent = message;
  alert.classList.add('alert', `alert-${type}`);
  document.querySelector('#step-2 p').appendChild(alert);
  setTimeout(() => {
    alert.remove();
  }, 3000);
}

const showSummary = () => {
  const summary = document.querySelector('.summary');
}