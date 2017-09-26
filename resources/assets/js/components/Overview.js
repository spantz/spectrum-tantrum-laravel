import React, { Component } from 'react';
import ReactDOM from 'react-dom';

class Overview  extends Component {
    constructor(props, options){
      super(props, options);
      console.log(props);
      // this.state = {
      //  average: 50,
      //  cy: 50,
      //  r: 10
      // }
    }

    render(){
      return  (
       <div>
          <svg width="870px" height="218px" viewBox="75 166 870 218" version="1.1" xmlns="http://www.w3.org/2000/svg">
              <g id="Page-1" stroke="none" strokeWidth="1" fill="none" fillRule="evenodd">
                  <g id="Download-View">
                      <g id="Rectangle-3">
                          <rect id="path-1" fill="#2E8DD6" fillRule="evenodd"  x="75" y="198" width="870" height="158"></rect>
                          <rect stroke="#979797" strokeWidth="1" x="75.5" y="198.5" width="869" height="157"></rect>
                      </g>
                      <rect id="Rectangle-4" fillOpacity="0.3" fill="#D8D8D8" x="416" y="213" width="234" height="128"></rect>
                      <rect id="Rectangle-4" fillOpacity="0.3" fill="#D8D8D8" x="314" y="213" width="439" height="128"></rect>
                      <path d="M716,194 L716,359.00303" id="Line" stroke="#1C1C1C" strokeWidth="8" strokeLinecap="square"></path>
                      <path d="M534,194 L534,359.00303" id="Line-Copy" stroke="#FFFFFF" strokeWidth="8" strokeLinecap="square"></path>
                      <text  fontFamily="AvenirNext-Bold, Avenir Next" fontSize="14" fontWeight="bold" fill="#2E8DD6">
                          <tspan x="514" y="383">{this.props.average}</tspan>
                      </text>
                      <text fontFamily="AvenirNext-Bold, Avenir Next" fontSize="14" fontWeight="bold" fill="#2E8DD6">
                          <tspan x="630" y="383">24.23</tspan>
                      </text>
                      <text fontFamily="AvenirNext-Bold, Avenir Next" fontSize="14" fontWeight="bold" fill="#2E8DD6">
                          <tspan x="396" y="383">18.23</tspan>
                      </text>
                      <text fontFamily="AvenirNext-Bold, Avenir Next" fontSize="14" fontWeight="bold" fill="#2E8DD6">
                          <tspan x="294" y="383">15.23</tspan>
                      </text>
                      <text fontFamily="AvenirNext-Bold, Avenir Next" fontSize="14" fontWeight="bold" fill="#000000">
                          <tspan x="706" y="177">25</tspan>
                      </text>
                      <text fontFamily="AvenirNext-Bold, Avenir Next" fontSize="14" fontWeight="bold" fill="#2E8DD6">
                          <tspan x="733" y="383">26.23</tspan>
                      </text>
                  </g>
              </g>
          </svg>
       </div>
      );
    }
  }

  export default Overview;
