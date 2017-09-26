import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import DashboardView from './DashboardView.js';
import Overview from './Overview.js';
import moment from 'moment';

class Dashboard  extends Component {

    constructor(props, options){
      super(props, options);
      let {overview, divided} = props.data;
      this.state = {
        "activeView": 'download',
        "overview": overview,
        "dates": divided.dates.map(d => moment(d).format("MMM Do h:mm a")),
        "ping": divided.ping,
        "uploads": divided.up.map(speed => (speed/1000)*8 ),
        "downloads": divided.down.map(speed => (speed/1000)*8 ),
        "supposedSpeed": 100
      };

      this.viewChange = this.viewChange.bind(this);
    }

    viewChange(e){
      this.setState({activeView: e.target.options[e.target.selectedIndex].value})
    }

    activeView(){
      if (this.state.activeView == "download") {
        return (<DashboardView labels={this.state.dates} lineData={this.state.downloads} label="Downloads"/>)
      }  else if (this.state.activeView == "upload") {
        return (<DashboardView labels={this.state.dates} lineData={this.state.uploads} label="Uploads"/>)
      } else {
        return (<DashboardView labels={this.state.dates} lineData={this.state.ping} label="Ping"/>)
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
                <option value="ping">Ping</option>

              </select>
            </div>
            <Overview average={this.state.overview.downloadAverage} std={this.state.overview.downloadStandardDeviation}/>
            {this.activeView()}
          </div>
      );
    }
  }

  export default Dashboard;
