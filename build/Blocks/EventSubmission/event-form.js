(()=>{class e{constructor(e){this.form=document.querySelector(e),this.setupEventListeners()}setupEventListeners(){this.form&&this.form.addEventListener("submit",(e=>{e.preventDefault(),this.submitForm()}))}async submitForm(){const e=new FormData(this.form),t={title:e.get("event_name"),content:e.get("event_description"),meta:{_event_date:e.get("event_date"),_event_location:e.get("event_location")},status:"publish"};try{const e=await fetch("/wp-json/wp/v2/event",{method:"POST",headers:{"Content-Type":"application/json","X-WP-Nonce":wpApiSettings.nonce},body:JSON.stringify(t)}),n=await e.json();e.ok?(alert("Event submitted successfully!"),this.form.reset()):alert("Error: "+n.message)}catch(e){console.error("Submission failed",e)}}}document.addEventListener("DOMContentLoaded",(()=>{new e("#event-submission-form")}))})();