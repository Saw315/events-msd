# MSD Events Theme - README

## Installation and Activation

### Step 1: Download the Theme

1. Clone or download the theme from the repository.
2. Extract the theme folder `msd-events` if downloaded as a zip.

### Step 2: Install and Activate the Theme

1. Upload the `msd-events` folder to `wp-content/themes/` via FTP **or** go to **Appearance > Themes > Add New** in
   WordPress and upload the zip file.
2. Activate the theme under **Appearance > Themes**.

### Step 3: Configure Google Maps API Key

To enable Google Maps functionality:

1. Navigate to **MSD Events**.
2. Enter your **Google Maps API key** in the settings field.
3. Click **Save Changes**.

---

## Shortcodes and Templates

### **Shortcode for Event Submission Form**

To display the **frontend event submission form**, use the shortcode:

```
[msd_event_form]
```

Place this shortcode inside any **page, post, or widget area** to allow users to submit events.

### **Upcoming Events Page Template**

To display a list of upcoming events:

1. **Create a new page** in WordPress.
2. **Select the "Upcoming Events" template** from the Page Attributes.
3. **Publish the page.**

This page will automatically display all upcoming events along with a Google Map showing event locations.

---

## Theme Structure and File Descriptions

### **Root Theme Folder (msd-events/)**

This contains the main theme files, including:

- `functions.php` – Loads theme features and dependencies.
- `style.css` – The main stylesheet.
- `theme.json` – Defines WordPress global styles and settings.
- `page-upcoming-events.php` – Template for displaying upcoming events.

### **`assets/` - Theme Assets**

This folder contains compiled and source assets.

### **`src/` - PHP Source Files**

Contains theme logic and functionality.

```
src/
│── Api/         (REST API handlers)
│── Blocks/      (Custom Gutenberg blocks)
│── CustomFields/ (Custom meta fields for event data)
│── Features/    (Additional theme features, shortcode in this example)
│── Managers/    (Handles CPTs, taxonomies, API calls)
│── Settings.php (Theme settings page for API key management)
│── Frontend.php (Enqueues assets and theme setup functions)
```

- `Api/` – Manages REST API calls for event submissions.
- `Blocks/` – Custom Gutenberg blocks (future expansion).
- `CustomFields/` – Stores custom fields for events (e.g., date, location).
- `Features/` – Additional event-related functionality.
- `Managers/` – Registers CPTs, taxonomies, and APIs.
- `Settings.php` – Admin settings page for API key input.
- `Frontend.php` – Handles styles, scripts, and theme setup.

### **`templates/` - Page Templates**

Contains additional page templates (currently `template-events.php`).

---

## Development Notes

### **Build System (SCSS & JS)**

The theme uses **Webpack** for JavaScript and SCSS compilation.

#### **Install Dependencies**

Run the following command inside the theme folder:

```
npm install
```

#### **Compile SCSS & JS**

```
npm run build
```

To watch for changes and auto-compile:

```
npm run watch
```

---

## **Final Notes**

- Ensure that **Google Maps API key** is added under **MSD Events** for maps to work.
- Use the **shortcode** `[msd_event_form]` to display the event submission form.
- Use the **Upcoming Events template** to list events with Google Maps integration.
