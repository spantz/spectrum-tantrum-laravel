import React from 'react';
import ReactDOM from 'react-dom';

import {Line} from 'react-chartjs-2';
import moment from 'moment';

const testData = {
    "dates": ["2017-07-17 00:00:00", "2017-07-17 00:05:00", "2017-07-17 01:15:00", "2017-07-17 01:50:00", "2017-07-17 02:15:00"],
    "down": [3184, 2482, 12345, 1223, 33333],
    "up": [3184, 2482, 12345, 1223,33333].reverse()
};

let labels = testData.dates.map(d => moment(d).format("MMM Do h:mm a"))

export default({data, options}) => {
    console.log(testData.down);
    const lineData = {
        labels: labels,
        datasets: [
            {
                label: "Download Speed (mpbs)",
                backgroundColor: "#047DB6",
                data: testData.down
            },
            {
                label: "Upload Speed (mpbs)",
                backgroundColor: "#f6b41c",
                data: testData.up
            }
        ]
    };
    return (
        <Line data={lineData} options={{animation: { duration: 0 }, hover: {}, animationDuration: 0,  responsiveAnimationDuration: 0}}></Line>
    )
}