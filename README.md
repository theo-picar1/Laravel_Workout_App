<div align="center">

# 💪 FORGED: Next-Gen Fitness Tracker

  ![Laravel Shield](https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
  ![PHP Shield](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)
  ![Status Shield](https://img.shields.io/badge/Status-Completed-brightgreen?style=for-the-badge)

  <img src="public\images\app-logo.png" alt="Forged App Screenshot" width="200" style="border-radius: 15px; margin: 20px 0; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">


## 🚀 Revolutionizing Fitness Tracking

**Forged** is a ***modern fitness companion*** that helps users track workouts, connect with others, and stay motivated. Built with Laravel 12, it combines powerful tracking with social features in a sleek interface.


## ✨ Key Features


### 🧑‍🤝‍🧑 **Social Fitness Experience**
| Feature | Description |
|---------|-------------|
| **👥 Community Network** | Follow friends, share progress, and have friendly competitions |
| **🏆 Community Advice** | Post your workouts and get real time and honest feed back on them |
| **💬 Activity Feed** | See and interact with posts from people you follow and people from all over the app |

### 🏋️ **Workout Management**
| Feature | Description |
|---------|-------------|
| **📊 Smart Tracking** | Log exercises, sets, reps, and weights with intuitive inputs |
| **📈 Progress History** | History page to see how your strength and endurance improved |
| **🔄 Routine Templates** | Save and reuse your favorite workout plans |

### 💻 **Technical Excellence**
| Feature | Description |
|---------|-------------|
| **⚡ Real-time Updates** | Instant sync across devices without page reloads |
| **📱 Mobile Design** | Perfect experience on all phones |


<p>
  <em>...and many more features to supercharge your fitness journey!</em> 🚀
</p>

## 🛠 Technology Stack


### **🔧 Core Stack**

| Category       | Technologies                                                                 | Purpose                          |
|----------------|-----------------------------------------------------------------------------|----------------------------------|
| **Backend**    | ![Laravel](https://img.shields.io/badge/Laravel-FF2D20?logo=laravel&logoColor=white) ![PHP](https://img.shields.io/badge/PHP-777BB4?logo=php&logoColor=white) | Robust API and server-side logic |
| **Frontend**   | ![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?logo=javascript&logoColor=black) ![jQuery](https://img.shields.io/badge/jQuery-0769AD?logo=jquery&logoColor=white) ![SCSS](https://img.shields.io/badge/SCSS-CC6699?logo=sass&logoColor=white) | Dynamic UI and styling |
| **Database**   | ![MySQL](https://img.shields.io/badge/MySQL-4479A1?logo=mysql&logoColor=white) | Data storage and retrieval |
| **DevOps**     | ![Azure](https://img.shields.io/badge/Azure-0078D4?logo=microsoft-azure&logoColor=white) ![GitHub Actions](https://img.shields.io/badge/GitHub_Actions-2088FF?logo=github-actions&logoColor=white) | Cloud hosting and CI/CD |


<p>
  <em>Engineered for athletes who demand precision and performance.</em> 💪
</p>

## 📸 App Preview

<div align="center">
  <h3>Experience Forged in Action</h3>
  
  <!-- First Row -->
  <table>
    <tr>
      <td width="50%" align="center">
        <img src="public\images\workoutPage.png"  style="max-width: 200px; max-height: 400px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
        <p><strong>Workout Tracking</strong><br>Log exercises with precision</p>
      </td>
      <td width="50%" align="center">
        <img src="public\images\discoverPage.png"  style="max-width: 200px; max-height: 400px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
        <p><strong>Community Hub</strong><br>Connect with fellow athletes</p>
      </td>
    </tr>
  </table>

  <!-- Second Row -->
  <table>
    <tr>
      <td width="50%" align="center">
        <img src="public\images\exercisesPage.png"  style="max-width: 200px; max-height: 400px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
        <p><strong>Exercise Library</strong><br>A plethora of exercises at your fingertips</p>
      </td>
      <td width="50%" align="center">
        <img src="public\images\profilePage.png"  style="max-width: 200px; max-height: 400px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
        <p><strong>Your Progress</strong><br>Visualize your fitness journey</p>
      </td>
    </tr>
  </table>
</div>

## 🗃️ Database Schema

<div align="center">
  <h3>Entity Relationship Diagram</h3>
  
  <img src="public/images/ERDNewDiagram.png" alt="FORGED ERD" style="max-width: 800px; width: 100%; border-radius: 12px; box-shadow: 0 8px 20px rgba(0,0,0,0.1); margin: 20px 0; border: 1px solid #eee;">

  ### 🔑 Core Entities & Relationships
  <div style="display: flex; flex-wrap: wrap; justify-content: space-between; max-width: 800px; margin: 0 auto;">
    <div style="flex: 1; min-width: 300px; padding-right: 20px;">
      <div style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); padding: 15px; border-radius: 10px; box-shadow: 0 3px 10px rgba(0,0,0,0.08); border-left: 4px solid #FF2D20; margin-bottom: 15px;">
        <strong style="color: #FF2D20;">Users</strong> 👥<br>
        <p style="margin: 8px 0 0; font-size: 0.85em; color: #495057;">Central identity management with authentication and profile data</p>
      </div>

  <div style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); padding: 15px; border-radius: 10px; box-shadow: 0 3px 10px rgba(0,0,0,0.08); border-left: 4px solid #4479A1; margin-bottom: 15px;">
        <strong style="color: #4479A1;">Routines</strong> 📅<br>
        <p style="margin: 8px 0 0; font-size: 0.85em; color: #495057;">Workout plans, templates and tracker</p>
      </div>

  <div style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); padding: 15px; border-radius: 10px; box-shadow: 0 3px 10px rgba(0,0,0,0.08); border-left: 4px solid #CC6699; margin-bottom: 15px;">
        <strong style="color: #CC6699;">Exercises</strong> 💪<br>
        <p style="margin: 8px 0 0; font-size: 0.85em; color: #495057;">Extensive exercise templete library</p>
      </div>
    </div>

  <div style="flex: 1; min-width: 300px;">
      <div style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); padding: 15px; border-radius: 10px; box-shadow: 0 3px 10px rgba(0,0,0,0.08); border-left: 4px solid #2088FF; margin-bottom: 15px;">
        <strong style="color: #2088FF;">Posts</strong> 💬<br>
        <p style="margin: 8px 0 0; font-size: 0.85em; color: #495057;">User-generated content and community interactions</p>
      </div>

  <div style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); padding: 15px; border-radius: 10px; box-shadow: 0 3px 10px rgba(0,0,0,0.08); border-left: 4px solid #FF6B6B; margin-bottom: 15px;">
        <strong style="color: #FF6B6B;">Likes</strong> ❤️<br>
        <p style="margin: 8px 0 0; font-size: 0.85em; color: #495057;">Engagement tracking and social validation</p>
      </div>

  <div style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); padding: 15px; border-radius: 10px; box-shadow: 0 3px 10px rgba(0,0,0,0.08); border-left: 4px solid #20C997; margin-bottom: 15px;">
        <strong style="color: #20C997;">Follows</strong> 🔄<br>
        <p style="margin: 8px 0 0; font-size: 0.85em; color: #495057;">User connections and social interations</p>
      </div>
    </div>
  </div>

  <div style="background: #f5f7fa; padding: 20px; border-radius: 12px; max-width: 800px; margin: 25px auto; border-left: 5px solid #777BB4;">
    <h4 style="margin-top: 0; color: #343a40;">Database Highlights</h4>
    <ul style="columns: 2; column-gap: 30px; font-size: 0.9em;">
      <li>🚀 <strong>Optimized queries</strong> for workout analytics</li>
      <li>🔐 <strong>Secure relationships</strong> with proper constraints</li>
      <li>📈 <strong>Scalable structure</strong> for growing user base</li>
      <li>⚡ <strong>Efficient indexing</strong> on frequent queries</li>
      <li>🤝 <strong>Social features</strong> integrated at database level</li>
      <li>🔄 <strong>Soft deletes</strong> for data integrity</li>
    </ul>
  </div>

  <p style="max-width: 700px; margin: 20px auto; font-style: italic; color: #6c757d;">
    "The database powers both real-time workout tracking and social interactions while maintaining strict data consistency across all features."
  </p>
</div>

## 🚀 Getting Started

### ⚙️ Prerequisites

Ensure you have these installed:

| Tool          | Version    | Installation Guide                |
|---------------|------------|-----------------------------------|
| PHP           | 8.2+       | [php.net](https://www.php.net/downloads) |
| Composer      | 2.8.8+     | [getcomposer.org](https://getcomposer.org/download) |
| Node.js       | 18+        | [nodejs.org](https://nodejs.org) |
| MySQL         | 8.0+       | [Xampp](https://www.apachefriends.org/) |

<div align="center">

### Installation

<pre style="
    display: inline-block;
    text-align: left;
    margin: 0 auto;
    padding: 16px;
    background: #f6f8fa;
    border-radius: 6px;
    font-family: monospace;
    border: 1px solid #e1e4e8;
">
# Clone the repository
git clone https://github.com/theo-picar1/Laravel_Workout_App.git

# Install dependencies
composer install
npm install && npm run dev

# Configure environment
cp .env.example .env
php artisan key:generate

# Set up database
php artisan migrate
php artisan db:seed

# Start development server
php artisan serve

Visit http://localhost:8000 to start using Forged!
</pre>
</div>

## 🌍 Live Deployment

<div align="center">
  <h3>Now Live on Microsoft Azure</h3>
  
  <a href="https://forged-g3crdrfyb8bwhch5.northeurope-01.azurewebsites.net/" target="_blank" style="display: inline-block; background: #0078D4; color: white; padding: 15px 30px; border-radius: 8px; text-decoration: none; font-weight: bold; margin: 20px 0; box-shadow: 0 4px 12px rgba(0,120,212,0.3); transition: transform 0.2s;">
    🚀 Visit Live Site
  </a>

  <div style="background: #f3f6ff; padding: 20px; border-radius: 12px; max-width: 700px; margin: 0 auto; border-left: 4px solid #0078D4;">
    <h4 style="margin-top: 0; color: #0078D4;">Azure Deployment Details</h4>
    <div style="display: flex; flex-wrap: wrap; gap: 15px; justify-content: center;">
      <div style="background: white; padding: 12px 15px; border-radius: 8px; flex: 1; min-width: 200px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
        <strong>Service</strong><br>
        Azure App Service
      </div>
      <div style="background: white; padding: 12px 15px; border-radius: 8px; flex: 1; min-width: 200px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
        <strong>Database</strong><br>
        Azure Database for MySQL
      </div>
      <div style="background: white; padding: 12px 15px; border-radius: 8px; flex: 1; min-width: 200px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
        <strong>CI/CD</strong><br>
        GitHub Actions
      </div>
    </div>
  </div>

  <div style="margin-top: 25px; max-width: 700px;">
    <h4>Performance Highlights</h4>
    <ul style="text-align: left; columns: 2; column-gap: 40px; font-size: 0.9em;">
      <li>⚡ <strong>99.9% Uptime</strong> SLA</li>
      <li>🌐 <strong>Global CDN</strong> for fast loading worldwide</li>
      <li>🛡️ <strong>DDoS Protection</strong> enabled</li>
      <li>📈 <strong>Auto-scaling</strong> for traffic spikes</li>
      <li>🔒 <strong>SSL Encryption</strong> by default</li>
      <li>📊 <strong>Application Insights</strong> monitoring</li>
    </ul>
  </div>
</div>

## 👥 Authors


### Oisin Bell
[![GitHub](https://img.shields.io/badge/GitHub-181717?style=for-the-badge&logo=github)](https://github.com/osh-een)
[![LinkedIn](https://img.shields.io/badge/LinkedIn-0A66C2?style=for-the-badge&logo=linkedin)](https://www.linkedin.com/in/oisin-bell-81b265338/)

### Theo Picar
[![GitHub](https://img.shields.io/badge/GitHub-181717?style=for-the-badge&logo=github)]()
[![LinkedIn](https://img.shields.io/badge/LinkedIn-0A66C2?style=for-the-badge&logo=linkedin)]()


<p>
  <em>Let's build a fitter world together! ❤️</em>
</p>

</div>