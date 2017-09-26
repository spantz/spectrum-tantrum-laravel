import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import SpeedGraph from './SpeedGraph.js';
import moment from 'moment';


class Dashboard  extends Component {

    constructor(props, options){
      super(props, options);
      let data = props.data;
      this.state = {
        "activeView": 'download',
        "dates": data.user.user.dates.map(d => moment(d).format("MMM Do h:mm a")),
        "uploads": data.user.user.up.map(speed => (speed/1000)*8 ),
        "downloads": data.user.user.down.map(speed => (speed/1000)*8 ),
        "supposedSpeed": 100
      };

      this.viewChange = this.viewChange.bind(this);
    }

    viewChange(e){
      this.setState({activeView: e.target.options[e.target.selectedIndex].value})
    }

    activeView(){
      if (this.state.activeView == "download") {
        return <SpeedGraph labels={this.state.dates} lineData={this.state.downloads} label="Downloads"/>
      }  else {
        return <SpeedGraph labels={this.state.dates} lineData={this.state.uploads} label="Uploads"/>
      }
    }


    render(){
      return  (
          <div className="dashboard">
            <div className="dashboard-header">
              <h1>Dashboard</h1>
              <select className="input" value={this.state.activeView} onChange={this.viewChange}>
                <option value="download">Download</option>
                <option value="upload">Upload</option>
              </select>
            </div>
            {this.activeView()}
          </div>
      );
    }
  }

  export default Dashboard;
