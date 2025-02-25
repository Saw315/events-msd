class EventForm {
    constructor(formSelector) {
        this.form = document.querySelector(formSelector);
        this.setupEventListeners();
    }

    setupEventListeners() {
        if (this.form) {
            this.form.addEventListener("submit", (event) => {
                event.preventDefault();
                this.submitForm();
            });
        }
    }

    async submitForm() {
        const formData = new FormData(this.form);
        const data = {
            title: formData.get("event_name"),
            content: formData.get("event_description"),
            meta: {
                _event_date: formData.get("event_date"),
                _event_location: formData.get("event_location")
            },
            status: "publish"
        };

        try {
            const response = await fetch("/wp-json/wp/v2/event", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-WP-Nonce": wpApiSettings.nonce
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();
            if (response.ok) {
                alert("Event submitted successfully!");
                this.form.reset();
            } else {
                alert("Error: " + result.message);
            }
        } catch (error) {
            console.error("Submission failed", error);
        }
    }
}

document.addEventListener("DOMContentLoaded", () => {
    new EventForm("#event-submission-form");
});
