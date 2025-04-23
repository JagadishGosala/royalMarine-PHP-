# Invoice & Payment Management System-
📌 Overview
A PHP-based document processing and financial tracking system that streamlines invoice, expense, and TCS document uploads. It provides automated client-wise reports, payment status monitoring, and scheduled email alerts. The system also includes multi-level user access and a central dashboard for financial insights.

📁 Features
    📂 Document Upload
        Upload invoices, TCS documents, and expense files
    🧾 Financial Tracking
        Processes data and calculates client-wise outstanding payments
        Payment terms customizable per client
    📅 Due Date Monitoring
        Automatically tracks due dates and payment statuses
    📧 Email Notifications
        Sends scheduled summaries via email
    📊 Dashboard Insights
        Holistic financial overview with profits/losses by product
    🔐 Role-based Access Control
        Level 1: User – Uploads files (invoices, TCS, expenses)
        Level 2: Team Manager – Views and approves team documents
        Level 3: Admin/Finance Head – Accesses global dashboard with profitability insights

🧠 How It Works
Upload
    Users upload financial documents (CSV/XLSX)
Approval Workflow
    Managers review and approve their team's uploads
Processing
    Data is parsed, validated, and stored
Categorization
    Clients are marked as Paid, Pending, or Overdue
Dashboard & Reports
    Admins get a high-level dashboard showing:
        Profit/loss per product
        Outstanding invoices
        Payment timelines
Emails
    Periodic summaries are auto-sent to preconfigured addresses

⚠️ Notice
This is a legacy PHP version created as a demo prototype.
The live server it was connected to has been decommissioned, and parts of the system (file paths, APIs, cron jobs) are now non-functional.
