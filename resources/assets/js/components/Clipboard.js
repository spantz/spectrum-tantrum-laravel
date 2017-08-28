import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import clipboardJS from 'clipboard-js';

class Clipboard extends Component {

    constructor(props){
      super();
      this.copy = this.copy.bind(this);
    }

    copy(e){
      clipboardJS.copy(e.target.innerText);
    }

    render() {
      return (
        <div className="clipboard" onClick={this.copy}>
          {this.props.children}
        </div>
      );
    }
  }
  
  export default Clipboard;
  