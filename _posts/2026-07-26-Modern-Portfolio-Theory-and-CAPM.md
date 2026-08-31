---
layout: post
title: "From Markowitz's Efficient Frontier to CAPM"
date: 2026-07-26
categories: [CFA, Quantitative Finance, Portfolio Theory]
tags: [CFA Level I, Markowitz, CAPM, Efficient Frontier, Python]
excerpt: "We establish the connection between Markowitz’s mean-variance optimal portfolio, the Capital Allocation Line, and CAPM."
author: "Dr. Peter P. Lind"
reading_time: "7 min read"
---

Starting from the principles behind the optimal mean-variance portfolio, we’ll build our way toward CAPM and unpack the theory behind it.

This breakdown was inspired by insights I recently gained while studying for the CFA Level I exam—and I hope you find it as enlightening as I did.

We proceed as follows:

1. **Find the optimal portfolios in the Markowitz mean-variance framework with \(N\) assets**
   - Define the optimisation problem.
   - Solve the optimisation problem.

2. **Introduce a risk-free asset (The Two-Fund Separation Theorem)**
   - Establish the Capital Allocation Line (CAL).
   - Realise that investors can construct efficient portfolios as linear combinations of the risk-free asset and the unique tangency portfolio on the efficient frontier.

3. **Connect the CAL to the CAPM**
   - Assume that the optimal portfolio is the market portfolio.
   - Derive the expression for the CAPM.

4. **Conclusion**

5. **Appendix: Deriving CAPM from the CML via a Perturbation Argument**

---

## 1. Find the optimal portfolios in the Markowitz mean-variance framework with \(N\) assets
Let us formalize a market of $N$ risky assets. Let $R = (R_1, R_2, \dots, R_N)^T$ be the random vector of asset returns with expected return vector $\mu = E[R]$ and an $N \times N$ positive-definite covariance matrix $\Sigma$.

A portfolio is defined by a vector of weights $w = (w_1, w_2, \dots, w_N)^T$, where $w_i$ represents the proportion of wealth invested in asset $i$. The portfolio's expected return and variance are given by:

$$E[R_p] = w^T \mu = \sum_{i=1}^N w_i \mu_i$$

$$\sigma_p^2 = w^T \Sigma w = \sum_{i=1}^N \sum_{j=1}^N w_i w_j \sigma_{ij}$$

### The Optimization Problem
To construct the **Minimum-Variance Frontier**, an investor seeks the portfolio weights that minimize variance subject to achieving a target expected return $r^{\ast}$ and fully investing budget constraints:

$$\min_{w} \quad w^T \Sigma w$$

$$\text{subject to} \quad w^T \mu = r^{\ast} \quad \text{and} \quad \sum_{i=1}^N w_i = 1$$

When plotted in $(\sigma_p, E[R_p])$ space (cf. Figure 1 below), the solution to this quadratic optimization problem traces out the hyperbola representing the minimum-variance frontier. The unique portfolio with the lowest variance is called the Global Minimum Variance (GMV) portfolio. The Efficient Frontier consists of the portfolios on the upper branch of this hyperbola, starting from the GMV portfolio, which offer the maximum possible expected return for any given level of volatility.

### Solving the optimization problem
**Figure 1: Efficient Frontier, Individual assets, and the Capital Allocation Line (CAL)**

<!-- SVG Solved Optimization Chart -->
<div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5 bg-white p-3">
  <svg viewBox="0 0 650 360" class="w-100 h-auto" xmlns="http://www.w3.org/2000/svg" style="max-height: 400px;">
    <defs>
      <linearGradient id="efGrad" x1="0%" y1="100%" x2="100%" y2="0%">
        <stop offset="0%" stop-color="#0d6efd" stop-opacity="0.8"/>
        <stop offset="100%" stop-color="#20c997" stop-opacity="1"/>
      </linearGradient>
    </defs>
    <!-- Background grid -->
    <g stroke="#f0f2f5" stroke-width="1">
      <line x1="80" y1="50" x2="600" y2="50"/>
      <line x1="80" y1="110" x2="600" y2="110"/>
      <line x1="80" y1="170" x2="600" y2="170"/>
      <line x1="80" y1="230" x2="600" y2="230"/>
      <line x1="80" y1="290" x2="600" y2="290"/>
    </g>
    <!-- Axes -->
    <line x1="80" y1="310" x2="600" y2="310" stroke="#495057" stroke-width="2"/>
    <line x1="80" y1="310" x2="80" y2="30" stroke="#495057" stroke-width="2"/>
    <!-- Axis Labels -->
    <text x="340" y="345" text-anchor="middle" font-family="sans-serif" font-size="13" fill="#495057" font-weight="bold">Risk / Standard Deviation (σ_p)</text>
    <text x="30" y="170" text-anchor="middle" font-family="sans-serif" font-size="13" fill="#495057" font-weight="bold" transform="rotate(-90 30 170)">Expected Return (E[R_p])</text>
    <!-- R_rf mark -->
    <circle cx="80" cy="260" r="6" fill="#dc3545"/>
    <text x="65" y="264" text-anchor="end" font-family="sans-serif" font-size="13" fill="#dc3545" font-weight="bold">R_rf</text>
    <!-- Markowitz Bullet (Lower inefficient limb - dashed) -->
    <path d="M 180 250 Q 180 290 480 340" fill="none" stroke="#adb5bd" stroke-width="2.5" stroke-dasharray="5,5" stroke-linecap="round" stroke-linejoin="round"/>
    <!-- Efficient Frontier (Upper limb) - Pronounced classical arch, C1 continuous, tangent at P*(380, 110) -->
    <path d="M 180 250 Q 180 210 380 110 Q 440 80 530 65" fill="none" stroke="url(#efGrad)" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
    <!-- CAL Line from R_rf (80, 260) tangent to curve at P*(380, 110) -->
    <line x1="80" y1="260" x2="560" y2="20" stroke="#0d6efd" stroke-width="2.5" stroke-dasharray="6,4"/>
    <!-- GMV Dot -->
    <circle cx="180" cy="250" r="6" fill="#6c757d"/>
    <text x="110" y="254" font-family="sans-serif" font-size="12" fill="#495057" font-weight="bold">GMV Portfolio</text>
    <!-- Tangency Portfolio P* Dot -->
    <circle cx="380" cy="110" r="7.5" fill="#0d6efd" stroke="#fff" stroke-width="2"/>
    <text x="395" y="115" font-family="sans-serif" font-size="13" fill="#0d6efd" font-weight="bold">P* (Tangency / Market Portfolio M)</text>
    <!-- CAL Label -->
    <text x="410" y="45" font-family="sans-serif" font-size="13" fill="#0d6efd" font-weight="bold">CAL / CML (Slope = Sharpe Ratio)</text>
    <!-- Individual Assets scattered inside -->
    <circle cx="270" cy="230" r="4.5" fill="#adb5bd"/>
    <circle cx="370" cy="200" r="4.5" fill="#adb5bd"/>
    <circle cx="430" cy="170" r="4.5" fill="#adb5bd"/>
    <circle cx="320" cy="260" r="4.5" fill="#adb5bd"/>
    <text x="440" y="174" font-family="sans-serif" font-size="11" fill="#6c757d">Individual Assets</text>
  </svg>
</div>


## 2. Introduce a risk-free asset (The Two-Fund Separation Theorem)
Introducing a risk-free asset with deterministic return $R_{rf}$ (i.e., zero variance, $\sigma_{rf}=0$, and zero covariance with all risky assets, $\operatorname{Cov}(R_{rf},R_i)=0$ for all $i\in{1,2,\ldots,N}$) allows us to construct a Capital Allocation Line (CAL). By combining the risk-free asset with the optimal tangency portfolio, the CAL offers a higher expected return for any given level of risk than the original efficient frontier.

### Establish the Capital Allocation Line (CAL).

Suppose an investor allocates weight $w$ to a risky portfolio $p^{\ast}$ on the efficient frontier, and weight $(1 - w)$ to the risk-free asset. The return of this combined portfolio is:

$$R_p = (1 - w) R_{rf} + w R_{p^{\ast}} = R_{rf} + w(R_{p^{\ast}} - R_{rf})$$

Taking expectations on both sides gives:

$$E[R_p] = R_{rf} + w \big(E[R_{p^{\ast}}] - R_{rf}\big)$$

Because the risk-free asset has zero variance and zero covariance, the variance of the combined portfolio depends solely on the risky portfolio $p^{\ast}$:

$$\sigma_p = \sqrt{w^2 \sigma_{p^{\ast}}^2} = |w| \sigma_{p^{\ast}} \implies |w| = \frac{\sigma_p}{\sigma_{p^{\ast}}}$$

Substituting the expression for $w$ back into the expected return equation yields the linear equation known as the **Capital Allocation Line (CAL)**:

$$E[R_p] = R_{rf} + \sigma_p \cdot \frac{E[R_{p^{\ast}}] - R_{rf}}{\sigma_{p^{\ast}}}$$

Looking back at figure 1, we see choosing $p^{\ast}$ to be the tangency portfolio, the resulting CAL is tangent to the efficient frontier and dominates it.

<!-- ```
       E[R_p] ▲
              │                                      . - '' CAL (Capital Allocation Line)
              │                                 . - ''    /
              │                            . - ''        /  Efficient Frontier
              │                       . - ''  (Tangency p*)
              │                  . - ''      /
              │             . - ''          /
              │        . - ''
       R_rf   ├─── . - ''
              │
              └──────────────────────────────────────────────► σ_p (Volatility)
``` -->

### The Two-Fund Separation
The slope of the CAL is precisely the **Sharpe Ratio** of the risky portfolio $p^{\ast}$:

$$\text{Sharpe Ratio} = \frac{E[R_{p^{\ast}}] - R_{rf}}{\sigma_{p^{\ast}}}$$

To maximize the slope of the CAL, we find the line from $R_{rf}$ that is **tangent** to the efficient frontier. This tangency portfolio $p^{\ast}$ is unique. 

This leads to Tobin's **Two-Fund Separation Theorem**: every rational mean-variance investor, regardless of their personal risk aversion, will choose to hold a combination of just two funds:
1. The risk-free asset ($R_{rf}$)
2. The optimal tangency risky portfolio ($p^{\ast}$)

Individual risk preference only dictates the allocation weight $w$ along the CAL (lending vs. borrowing at $R_{rf}$), not the composition of the risky portfolio itself.

---

## 3. From Capital Market Line (CML) to CAPM & The Security Market Line

In a market equilibrium where all investors share homogeneous expectations and access the same information, every investor holds the same tangency portfolio $p^{\ast}$. By market clearing, $p^{\ast}$ must be the **Market Portfolio ($M$)** containing all risky assets weighted by their market value.

When $p^{\ast} = M$, the CAL becomes the **Capital Market Line (CML)**:

$$E[R_p] = R_{rf} + \sigma_p \cdot \frac{E[R_M] - R_{rf}}{\sigma_M}$$

### Why CML Cannot Price Individual Assets
The CML prices *efficient portfolios* based on total volatility ($\sigma_p$). However, an individual asset $i$ held within the market portfolio is not priced based on its total standard deviation $\sigma_i$. Why? Because a large portion of an individual asset's risk is **idiosyncratic (diversifiable)** and vanishes when combined with other assets.

### Deriving the Security Market Line (SML)
To determine the equilibrium return of an individual asset $i$, we measure its marginal contribution to the risk of the market portfolio. This is governed by its covariance with the market return, $\text{cov}(R_i, R_M)$. *(For a formal mathematical derivation using perturbation, see the Appendix.)*

In equilibrium, the required excess return of any asset is proportional to its contribution to market risk, leading to the **Capital Asset Pricing Model (CAPM)** and the **Security Market Line (SML)**:

$$E[R_i] - R_{rf} = \beta_i \big(E[R_M] - R_{rf}\big)$$

where the asset's beta ($\beta_i$) measures its **systematic risk**:

$$\beta_i = \frac{\text{cov}(R_i, R_M)}{\text{var}(R_M)} = \rho_{i,M} \frac{\sigma_i}{\sigma_M}$$

### Systematic vs. Idiosyncratic Risk
Notice that if an asset is perfectly correlated with the market ($\rho_{i,M} = 1$), its beta simplifies to $\beta_i = \frac{\sigma_i}{\sigma_M}$. However, when $\rho_{i,M} < 1$, the asset earns less risk premium than its total volatility $\sigma_i$ might suggest.

In a competitive market, investors are **only compensated for bearing systematic risk** ($\beta_i$), because idiosyncratic risk can be costlessly eliminated through diversification.



## 4. The Paradigm Shift: From Individual Assets to Portfolios

Before Markowitz's seminal 1952 paper, investment analysis often evaluated individual securities in isolation—seeking assets with the highest expected returns and lowest individual variances. Markowitz formalized a critical insight: **an asset's risk should not be assessed in isolation, but by how it contributes to the overall risk of a diversified portfolio.**

By exploiting imperfect correlations between asset returns, investors can construct portfolios that achieve higher expected returns for a given level of variance, or lower variance for a target expected return.

---

## Summary

* **Modern Portfolio Theory (Markowitz)** shows that diversification reduces variance without necessarily sacrificing expected return by combining imperfectly correlated assets.
* **The Two-Fund Separation Theorem** proves that introducing a risk-free rate allows all mean-variance investors to hold combinations of just two funds: the risk-free asset and the tangency portfolio $p^{\ast}$.
* **The Capital Allocation Line (CAL)** defines the optimal risk-return tradeoff across combinations of $R_{rf}$ and $p^{\ast}$.
* **The Capital Asset Pricing Model (CAPM)** demonstrates that in market equilibrium, an individual asset's required excess return depends on its **systematic risk ($\beta$)** rather than its total volatility, because diversifiable risk is not rewarded in the marketplace.


---

## Appendix: Deriving CAPM from the CML via a Perturbation Argument

To bridge the step between the Capital Market Line (CML) and the Capital Asset Pricing Model (CAPM), we use a perturbation argument: we consider adding a small allocation of an individual asset $i$ to the already optimal Market Portfolio $M$ and calculate the resulting marginal rate of substitution.

### Step 1: Form a Perturbed Portfolio
Consider a portfolio consisting of a fraction $w$ invested in risky asset $i$ and $(1 - w)$ invested in the market portfolio $M$:

$$R(w) = w R_i + (1 - w) R_M$$

The expected return and standard deviation of this portfolio as functions of $w$ are:

$$E[R(w)] = w E[R_i] + (1 - w) E[R_M]$$

$$\sigma(w) = \sqrt{w^2 \sigma_i^2 + (1 - w)^2 \sigma_M^2 + 2w(1 - w)\text{Cov}(R_i, R_M)}$$

### Step 2: Compute Marginal Changes at $w = 0$
Take the derivative of both equations with respect to $w$ evaluated at $w = 0$ (the point where the portfolio is purely the market portfolio $M$):

**1. Marginal Expected Return:**

$$\left. \frac{d E[R(w)]}{dw} \right\vert_{w=0} = E[R_i] - E[R_M]$$

**2. Marginal Risk (Standard Deviation):**
Using the chain rule on $\sigma(w)$:

$$\frac{d \sigma(w)}{dw} = \frac{2w\sigma_i^2 - 2(1-w)\sigma_M^2 + 2(1-2w)\text{Cov}(R_i, R_M)}{2\sigma(w)}$$

Evaluating at $w = 0$ (where $\sigma(0) = \sigma_M$):

$$\left. \frac{d \sigma(w)}{dw} \right\vert_{w=0} = \frac{-\sigma_M^2 + \text{Cov}(R_i, R_M)}{\sigma_M} = \frac{\text{Cov}(R_i, R_M) - \sigma_M^2}{\sigma_M}$$

### Step 3: Compute the Slope in $(\sigma, E[R])$ Space
The slope of the curve traced out by this portfolio at $w = 0$ is:

$$\left. \frac{d E[R(w)]}{d \sigma(w)} \right\vert_{w=0} = \frac{\left. \frac{d E[R(w)]}{dw} \right\vert_{w=0}}{\left. \frac{d \sigma(w)}{dw} \right\vert_{w=0}} = \frac{E[R_i] - E[R_M]}{\frac{\text{Cov}(R_i, R_M) - \sigma_M^2}{\sigma_M}}$$

### Step 4: Tangency with the CML
Because $M$ is the optimal tangency portfolio in equilibrium, the curve formed by blending asset $i$ into $M$ cannot cross above the Capital Market Line. Thus, it must be tangent to the CML at $w = 0$.

The slope of the CML is the Sharpe ratio of the market (note we use $R_{rf}$ for the risk-free rate):

$$\text{Slope of CML} = \frac{E[R_M] - R_{rf}}{\sigma_M}$$

Equating the two slopes at $w = 0$:

$$\frac{E[R_i] - E[R_M]}{\frac{\text{Cov}(R_i, R_M) - \sigma_M^2}{\sigma_M}} = \frac{E[R_M] - R_{rf}}{\sigma_M}$$

Multiply both sides by $\frac{\text{Cov}(R_i, R_M) - \sigma_M^2}{\sigma_M}$:

$$E[R_i] - E[R_M] = \left(\frac{\text{Cov}(R_i, R_M) - \sigma_M^2}{\sigma_M^2}\right) \Big(E[R_M] - R_{rf}\Big)$$

$$E[R_i] - E[R_M] = \left( \frac{\text{Cov}(R_i, R_M)}{\sigma_M^2} - 1 \right) \Big(E[R_M] - R_{rf}\Big)$$

### Step 5: Rearrange to Yield CAPM
Expand the right-hand side:

$$E[R_i] - E[R_M] = \frac{\text{Cov}(R_i, R_M)}{\sigma_M^2} \Big(E[R_M] - R_{rf}\Big) - \Big(E[R_M] - R_{rf}\Big)$$

Add $E[R_M]$ to both sides:

$$E[R_i] = R_{rf} + \underbrace{\left(\frac{\text{Cov}(R_i, R_M)}{\sigma_M^2}\right)}_{\beta_i} \Big(E[R_M] - R_{rf}\Big)$$

### Intuition: Why $\frac{\sigma_p}{\sigma_M}$ becomes $\beta_i$
On the CML, a portfolio $p$ is fully diversified ($p$ is simply a mix of $R_{rf}$ and $M$). Its correlation with the market is $\rho_{p,M} = 1$, which makes its beta:

$$\beta_p = \frac{\text{Cov}(R_p, R_M)}{\sigma_M^2} = \frac{\rho_{p,M} \sigma_p \sigma_M}{\sigma_M^2} = \frac{(1)\sigma_p \sigma_M}{\sigma_M^2} = \frac{\sigma_p}{\sigma_M}$$

For an individual asset $i$, $\rho_{i,M} < 1$ because of idiosyncratic risk. The market only prices the marginal risk added to $M$, which scales by correlation $\rho_{i,M}$:

$$\beta_i = \rho_{i,M} \frac{\sigma_i}{\sigma_M} = \frac{\text{Cov}(R_i, R_M)}{\sigma_M^2}$$

---

## References & Recommended Reading

1. **CFA Institute.** *CFA Program Curriculum (Level I)*. Specifically Readings on Portfolio Management: *Portfolio Risk and Return: Part I & II*, *Mean-Variance Analysis*, and *The Capital Asset Pricing Model (CAPM)*.
2. **Elton, E. J., Gruber, M. J., Brown, S. J., & Goetzmann, W. N.** *Modern Portfolio Theory and Investment Analysis* (9th/10th Ed.). John Wiley & Sons.
3. **Markowitz, H.** (1952). *Portfolio Selection*. The Journal of Finance, 7(1), 77–91.
4. **Sharpe, W. F.** (1964). *Capital Asset Prices: A Theory of Market Equilibrium under Conditions of Risk*. The Journal of Finance, 19(3), 425–442.
<!-- 5. **Google Gemini (AI Assistant).** Assistance with LaTeX mathematical formatting, interactive SVG data visualizations, and web styling. -->

---

> **Compliance Disclaimer:** The views, thoughts, and opinions expressed in this article and across this website are strictly my own and do not represent the views, policies, or official positions of my employer, **Verition Fund Management** (or any of its affiliates, funds, or clients). All content is provided solely for educational, academic, and personal study purposes—including notes and syntheses from the CFA Level I curriculum and academic textbooks—and does not constitute investment advice, financial research, or an offer or solicitation to trade any security or financial product.

