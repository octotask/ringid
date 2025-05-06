# Content Directory Structure

This directory contains the main content for the ringid.com site. To improve maintainability, group content by feature or domain:

- `news/` — News articles, grouped by year or topic.
- `blog/` — Blog posts and related assets.
- `media/` — Images, videos, and other media files.
- `static_pages/` — Static HTML or markdown pages.
- Additional subdirectories can be created for other content types as needed.

Each subfolder should include a README describing its contents and structure.

---

# To Run the project from local:

* Clone the project
* cd ringIDWeb
* Need to Run Server Projects
    - In `LoadbalancerForUDPServer` - set the `ringIDWeb` path as `contextPath` in `config.properties` file
    - In `UDPServer` - set the `ringIDWeb` path as `serverContextFolder` in `server.xml` file
* npm install (make sure node version is above 4)
* grunt local
* Browse http://localhost:8080/#/