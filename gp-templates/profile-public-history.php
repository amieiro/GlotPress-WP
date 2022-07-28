    <!-- https://bitsofco.de/github-contribution-graph-css-grid/ -->

    <style>
        /* Article - https://bitsofco.de/github-contribution-graph-css-grid/ */

        /* Grid-related CSS */

        :root {
            --square-size: 15px;
            --square-gap: 5px;
            --week-width: calc(var(--square-size) + var(--square-gap));
        }

        .months { grid-area: months;
            list-style-type: none;}
        .days { grid-area: days;
            list-style-type: none;}
        .squares { grid-area: squares;
            list-style-type: none;}

        .graph {
            display: inline-grid;
            grid-template-areas: "empty months"
                       "days squares";
            grid-template-columns: auto 1fr;
            grid-gap: 10px;
        }

        .months {
            display: grid;
            grid-template-columns: calc(var(--week-width) * 4) /* Jan */
                         calc(var(--week-width) * 4) /* Feb */
                         calc(var(--week-width) * 4) /* Mar */
                         calc(var(--week-width) * 5) /* Apr */
                         calc(var(--week-width) * 4) /* May */
                         calc(var(--week-width) * 4) /* Jun */
                         calc(var(--week-width) * 5) /* Jul */
                         calc(var(--week-width) * 4) /* Aug */
                         calc(var(--week-width) * 4) /* Sep */
                         calc(var(--week-width) * 5) /* Oct */
                         calc(var(--week-width) * 4) /* Nov */
                         calc(var(--week-width) * 5) /* Dec */;
        }

        .days,
        .squares {
            display: grid;
            grid-gap: var(--square-gap);
            grid-template-rows: repeat(7, var(--square-size));
        }

        .squares {
            grid-auto-flow: column;
            grid-auto-columns: var(--square-size);
        }


        /* Other styling */

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
            font-size: 12px;
        }

        .graph {
            padding: 20px;
            border: 1px #e1e4e8 solid;
            margin: 20px;
        }

        .days li:nth-child(odd) {
            visibility: hidden;
        }

        .squares li {
            background-color: #ebedf0;
        }

        .squares li[data-level="1"] {
            background-color: #c6e48b;
        }

        .squares li[data-level="2"] {
            background-color: #7bc96f;
        }

        .squares li[data-level="3"] {
            background-color: #196127;
        }
    </style>
    <script >
        // Add squares
        window.onload = function () {
            const squares = document.querySelector('.squares');
            console.log(squares);
            for (var i = 1; i < 366; i++) {
                const level = Math.floor(Math.random() * 3);
                var d = new Date();
                d.setDate(d.getDate() - 366 + i + 1);
                console.log(d);
                squares.insertAdjacentHTML('beforeend', `<li data-level="${level}" title="${level} translations on ${d.getFullYear()}-${d.getMonth()+1}-${d.getDate()}"></li>`);
            }
        }
    </script>
    <div class="graph">
        <ul class="months">
            <?php
            for ($i = 1; $i <= 12; $i++) {
	            $month = date("M", strtotime( date( 'Y-m-01' )." +$i months"));
                echo '<li>' . $month . '</li>';
            }
            ?>
        </ul>
        <ul class="days">
            <li>Sun</li>
            <li>Mon</li>
            <li>Tue</li>
            <li>Wed</li>
            <li>Thu</li>
            <li>Fri</li>
            <li>Sat</li>
        </ul>
        <ul class="squares">
            <!-- added via javascript -->
        </ul>
    </div>