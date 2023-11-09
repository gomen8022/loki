# Technology for Conversion Rate Enhancement and Adaptive Response to User Activity on Web Pages

This technology serves as a powerful tool for enhancing the user experience on web pages, allowing sites to adapt to individual users and their needs.
Key components of the technology:

    Page Blocks: Each page contains a certain number of blocks, with each block having three versions.
    Analytical Part: Gathers information about users visiting the page:
       - User's device type.
       - Browser used.
       - User's origin.
       - Time spent on a particular block.
       - Number of clicks/taps on a block.
    A/B Testing: The first 200 users are provided with a random distribution of blocks to determine user reactions to different versions of blocks.
    Heuristic Algorithm: After analyzing the behavior of the first 200 users, the algorithm creates a "snapshot" of the page best suited to a particular type of user. From 200 to 500 users.
    Behavioral Algorithm: From 500 to 2000 users.
    Neural Network: From 2000 users onwards.

# This heuristic algorithm is developed for the adaptive display of content blocks on a website.<br>
Taking into account the personal characteristics of the user. <br>
Its main stages:

    User Analysis: When a user visits the site, the algorithm collects information about their location and "user agent" (technical information about the browser and user device).
    Data Filtering: Based on the collected "user agent", the algorithm searches for similar users in the database and selects those records that most closely match the current user.
    Block Analysis: The algorithm then analyzes which blocks and their versions most frequently interacted with similar users.
    Blocks Reformatting: After analyzing the blocks, the algorithm filters and sorts them. Content deemed unnecessary or less relevant is filtered out. The blocks are then sorted so that the user sees the most relevant and interesting content.
    Content Display: The user receives a web page with sorted content blocks, optimized specifically for them based on the analysis of their location and device.
# Advantages of the technology:
    Increased Conversion: Thanks to the individual approach to each user, conversion can double.
    Optimized Site Engagement Time: Adaptive content can encourage the user to spend more time on the site, enhancing their engagement.

# Usage
To use the library, you need to follow a few steps:

1. **Include the JavaScript Script for User Behavior Analytics**: <br>
   The script can be found in the `assets/js/*` folder. There are three versions of the script: plain JavaScript, Vue.js, and jQuery. Feel free to use any of them as per your requirement.

2. **Collecting Statistics in Two Aspects**:<br>
    - Collect data when a user makes a conversion.
    - Collect analytics when a user simply visits your resource.
      Here's how you can use the LokiHandler:

   ```php
   use Loki\LokiHandler;

   // For posting statistics
   LokiHandler::postStatistic($params);

   // For posting analytic statistics
   LokiHandler::postAnalyticStatistic($params);
   
You can find examples of proper $params validation in tests/LokiTest::testPostStatistic.

3. **Sending Statistics to the Main Server Once a Day**:<br>
   You can configure this according to your scheduler. The data is saved automatically when using the previous method. The saved data from session.json is then sent for processing:
    ```php
   use Loki\LokiHandler;

    LokiHandler::sendStatistic();
4. **To Retrieve Aggregate Data for Your Web Resource**:<br>
   You need to make a request to get the page blocks:
     ```php
   use Loki\LokiHandler;

    LokiHandler::getPageBlocks($params);
Examples of validation data can be seen in tests/LokiTest::testGetPageBlocks, and you can also find an example response there.

**Note:** If you have any questions or suggestions, please feel free to reach out to us at ggommenn@gmail.com. 