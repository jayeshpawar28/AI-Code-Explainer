# AI Code Explainer
 An AI-powered web application that explains pasted source code in simple English, identifies key parts of the code, and detects time/space complexity when possible using an LLM (Mistral API).


# System Architecture & AI Tool Selection
 This project follows a simple client–server architecture. The frontend is built using HTML, CSS, and JavaScript, allowing users to submit code and view explanations dynamically. The backend is developed in PHP, which communicates with the AI model and returns structured responses to the UI. The system is designed to be lightweight and easy to run locally using XAMPP.

 The application uses the Mistral AI API for generating code explanations because it provides fast and reliable understanding of source code. A carefully structured prompt ensures clear, concise explanations without unnecessary assumptions.

# Tech Stack
 Frontend: HTML, CSS, JavaScript
 Backend: PHP (cURL for API requests)
 AI Model: Mistral (mistral-small)
 Server: Apache (XAMPP)
 API Communication: REST (JSON)

# How to Run the Project (XAMPP)

 Download or Clone the Repository
   git clone <your-github-repo-url>
 Or download the ZIP file and extract it.

 Move Project to XAMPP
 Copy the project folder into:
 C:\xampp\htdocs\

 Start XAMPP
 Open the XAMPP Control Panel
 Start Apache

 Configure API Key
 Open config.php
 Ensure your Mistral API key is present

 Run the Application
 Open a browser and visit:
 Ex. http://localhost/your-project-folder/

# Use the App
 Paste your code into the textarea
 Click Explain Code
 View explanations

 Thank You!
 
