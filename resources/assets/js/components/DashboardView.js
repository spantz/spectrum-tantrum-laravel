import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import {Line} from 'react-chartjs-2';


class SpeedGraph  extends Component {
    constructor(props, options){
      super(props, options);

      this.state = {
        data: [
          {
            "label": this.props.label,
            "backgroundColor": "rgba(0,0,0,.6)",
            "data": this.props.data
        },
        {
          "label": "Supposed speed",
          "backgroundColor": "rgba(255,0, 0, 1)",
          "data": [100]
        }
        ]
      }
    }


    render(){
      return  (
        <div>
          <Line data={{"labels": this.props.labels, "data": this.props.data}} options={{animation: { duration: 0 }, hover: {}, animationDuration: 0,  responsiveAnimationDuration: 0}}></Line>
        </div>
      );
    }
  }

  export default SpeedGraph;
