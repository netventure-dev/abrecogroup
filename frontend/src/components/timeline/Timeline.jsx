import React from 'react';
import './timeline.css';
import Dots from "../../images/footer-dots.webp";
import TimelineIcon from "../../images/timeline.webp";

const Timeline = () => {
    return (
        <>
            <section className='pageTitle timeline'>
                <div className='container'>
                    <div className='data'>
                        <img src={Dots} alt="" />
                        <p>Abreco Journey</p>
                        <h2>OUR MILESTONE</h2>
                        <small>Lorem ipsum dolor sit amet, consectetur adipiscing elit. <br/>Aenean pretium enim mauris, id posuere augue.</small>
                    </div>
                    <div class="steps-timeline">

                        <div class="step">
                            <div class="line"></div>
                            <div class="step-milestone">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2013</div>
                            <div class="stepData">
                                <img src={TimelineIcon} alt="" />
                                <span class="step-title">Title 1</span>
                                <p class="step-description">Lorem ipsum dolor sit amet, <br />consectetur adipiscing elit. Aenean <br />pretium enim mauris, id posuere augue.</p>
                            </div>
                        </div>

                        <div class="step">
                            <div class="line"></div>
                            <div class="step-milestone">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2013</div>
                            <div class="stepData">
                                <img src={TimelineIcon} alt="" />
                                <span class="step-title">Title 2</span>
                                <p class="step-description">Lorem ipsum dolor sit amet, <br />consectetur adipiscing elit. Aenean <br />pretium enim mauris, id posuere augue.</p>
                            </div>
                        </div>

                        <div class="step">
                            <div class="line"></div>
                            <div class="step-milestone">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2013</div>
                            <div class="stepData">
                                <img src={TimelineIcon} alt="" />
                                <span class="step-title">Title 3</span>
                                <p class="step-description">Lorem ipsum dolor sit amet, <br />consectetur adipiscing elit. Aenean <br />pretium enim mauris, id posuere augue.</p>
                            </div>
                        </div>

                        <div class="step">
                            <div class="line"></div>
                            <div class="step-milestone">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2013</div>
                            <div class="stepData">
                                <img src={TimelineIcon} alt="" />
                                <span class="step-title">Title 4</span>
                                <p class="step-description">Lorem ipsum dolor sit amet, <br />consectetur adipiscing elit. Aenean <br />pretium enim mauris, id posuere augue.</p>
                            </div>
                        </div>

                        <div class="step">
                            <div class="line"></div>
                            <div class="step-milestone">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2013</div>
                            <div class="stepData">
                                <img src={TimelineIcon} alt="" />
                                <span class="step-title">Title 5</span>
                                <p class="step-description">Lorem ipsum dolor sit amet, <br />consectetur adipiscing elit. Aenean <br />pretium enim mauris, id posuere augue.</p>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </>
    )
}

export default Timeline