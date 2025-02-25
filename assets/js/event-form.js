class EventForm {
    constructor(formSelector) {
        this.form = document.querySelector(formSelector);
        if (this.form) {
            this.setupEventListeners();
            this.initGoogleMapsAutocomplete();
        }
    }

    setupEventListeners() {
        this.form.addEventListener("submit", (event) => {
            event.preventDefault();
            this.clearErrors();
            if (this.validateForm()) {
                this.submitForm();
            }
        });

        this.form.querySelectorAll("input, textarea").forEach((input) => {
            input.addEventListener("input", () => {
                this.clearFieldError(input);
            });
        });
    }

    initGoogleMapsAutocomplete() {
        const locationInput = this.form.querySelector("#event_location");
        if (locationInput) {
            const autocomplete = new google.maps.places.Autocomplete(locationInput);
            autocomplete.addListener("place_changed", () => {
                const place = autocomplete.getPlace();
                this.form.querySelector("#event_latitude").value = place.geometry.location.lat();
                this.form.querySelector("#event_longitude").value = place.geometry.location.lng();
            });
        }
    }

    validateForm() {
        let isValid = true;

        const fields = [
            {id: "event_name", message: "Event Name is required."},
            {id: "event_description", message: "Event Description is required."},
            {id: "event_date", message: "Event Date is required."},
            {id: "event_location", message: "Event Location is required."}
        ];

        fields.forEach(field => {
            const input = this.form.querySelector(`#${field.id}`);
            if (!input.value.trim()) {
                this.showError(input, field.message);
                isValid = false;
            }
        });

        return isValid;
    }

    showError(input, message) {
        input.classList.add("error");
        const errorSpan = input.parentElement.querySelector(".error-message");
        errorSpan.textContent = message;
        errorSpan.style.color = "red";
    }

    clearErrors() {
        this.form.querySelectorAll(".error-message").forEach(span => {
            span.textContent = "";
        });
        this.form.querySelectorAll(".error").forEach(input => {
            input.classList.remove("error");
        });

        this.form.querySelector(".form-status").textContent = "";
    }

    clearFieldError(input) {
        input.classList.remove("error");
        const errorSpan = input.parentElement.querySelector(".error-message");
        errorSpan.textContent = "";
    }

    async submitForm() {
        const formData = new FormData(this.form);
        const data = {
            event_name: formData.get("event_name"),
            event_description: formData.get("event_description"),
            event_date: formData.get("event_date"),
            event_location: formData.get("event_location"),
            event_latitude: formData.get("event_latitude"),
            event_longitude: formData.get("event_longitude"),
        };

        const headers = {"Content-Type": "application/json"};

        try {
            const response = await fetch(msdEventFormData.ajax_url, {
                method: "POST",
                headers: headers,
                body: JSON.stringify(data),
            });

            const result = await response.json();
            if (response.ok) {
                this.form.querySelector(".form-status").textContent = "Event submitted successfully!";
                this.form.querySelector(".form-status").style.color = "green";
                this.form.reset();
            } else {
                this.showSubmissionError(result.message);
            }
        } catch (error) {
            console.error("Submission failed", error);
            this.showSubmissionError("An error occurred while submitting the form. Please try again.");
        }
    }

    showSubmissionError(message) {
        const statusDiv = this.form.querySelector(".form-status");
        statusDiv.textContent = message;
        statusDiv.style.color = "red";
    }
}

document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".msd-form").forEach(form => {
        new EventForm(`#${form.id}`);
    });
});
