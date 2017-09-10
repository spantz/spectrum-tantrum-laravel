import React from 'react';
import ReactDOM from 'react-dom';

import {Line} from 'react-chartjs-2';
import moment from 'moment';

export default({data, options}) => {

    const lineData = {
        labels: data.user.user.dates.map(d => moment(d).format("MMM Do h:mm a")),
        datasets: [
            {
                label: "Download Speed (mpbs)",
                backgroundColor: "rgba(0,0,0,.6)",
                data: data.user.user.down.map(speed => (speed/1000)*8 )
            },
            {
                label: "Upload Speed (mpbs)",
                backgroundColor: "rgba(0,0,0,.4)",
                data: data.user.user.up.map(speed => (speed/1000)*8 )
            },
            {
                label: "Supposed speed",
                backgroundColor: "rgba(255,0, 0, 1)",
                data: [100]
            },
        ]
    };
    return (
        <Line data={lineData} options={{animation: { duration: 0 }, hover: {}, animationDuration: 0,  responsiveAnimationDuration: 0}}></Line>
    )
}