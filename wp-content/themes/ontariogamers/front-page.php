<?php
/**
 * Homepage — "Best Online Casinos Ontario" money page.
 *
 * Hero (author + trust) → jump nav → Quick comparison → How we test →
 * 6 detailed reviews → Legality → How to choose → Responsible gambling →
 * FAQs → More reviews + news.
 *
 * Affiliate links, logos, screenshots and date labels are managed in
 * Appearance → Homepage Top 6 (see inc/home-top6.php).
 */

get_header();

$brands       = ontariogamers_top6_brands();
$table_brands = ontariogamers_top6_table_brands();

$hp_author   = get_user_by('login', 'philimorevanessa');
$author_name = $hp_author ? $hp_author->display_name : 'Vanessa';
$author_url  = $hp_author ? get_author_posts_url($hp_author->ID) : '';
$rg_url      = home_url('/responsible-gambling/');
?>

<main id="main" class="hp">

<!-- ═════════════════════════ HERO ═════════════════════════ -->
<section class="hp-hero" aria-labelledby="hp-title">
    <div class="hp-wrap hp-hero__grid">
        <div class="hp-hero__main">
            <ul class="hp-trust" aria-label="Player protections">
                <li class="hp-trust__item hp-trust__item--age">19+</li>
                <li class="hp-trust__item"><?php echo ontariogamers_icon('shield'); ?> AGCO Licensed Only</li>
                <li class="hp-trust__item"><a href="<?php echo esc_url($rg_url); ?>"><?php echo ontariogamers_icon('check'); ?> GambleAware</a></li>
            </ul>

            <h1 id="hp-title" class="hp-hero__title">
                Best Online Casinos Ontario
                <span class="hp-hero__sub">– <?php echo esc_html(ontariogamers_top6_date('h1_suffix')); ?></span>
            </h1>

            <div class="hp-byline">
                <?php if ($hp_author) : ?>
                    <?php echo get_avatar($hp_author->ID, 48, '', $author_name, array('class' => 'hp-byline__avatar')); ?>
                <?php endif; ?>
                <p class="hp-byline__text">
                    <span>By <?php if ($author_url) : ?><a href="<?php echo esc_url($author_url); ?>"><?php echo esc_html($author_name); ?></a><?php else : echo esc_html($author_name); endif; ?></span>
                    <span class="hp-byline__sep" aria-hidden="true">|</span>
                    <span><?php echo esc_html(ontariogamers_top6_date('byline_date')); ?></span>
                    <span class="hp-byline__sep" aria-hidden="true">|</span>
                    <span><?php echo ontariogamers_icon('pin'); ?> Ontario Resident</span>
                </p>
            </div>

            <p class="hp-hero__lead">
                We deposited $20 via Interac e-Transfer at 6 AGCO-licensed casinos, played real slots and timed
                withdrawals to our TD account. <strong>Fastest: bet365 – 1h 42min.</strong> <strong>Slowest: BetMGM – 6h 15m.</strong>
                Below is exactly what happened, with screenshots and dates.
            </p>

            <div class="hp-hero__ctas">
                <a href="#top-6" class="hp-btn hp-btn--gold">Compare the Top 6 <?php echo ontariogamers_icon('arrow'); ?></a>
                <a href="#how-we-test" class="hp-btn hp-btn--ghost">How We Test</a>
            </div>

            <p class="hp-disclosure">
                We earn commission – but we test with our own money. <a href="#how-we-test">See How We Test</a>
            </p>
        </div>

        <aside class="hp-glance" aria-label="Our test at a glance">
            <p class="hp-glance__title">Our test at a glance</p>
            <dl class="hp-glance__list">
                <div class="hp-glance__row">
                    <dt><?php echo ontariogamers_icon('wallet'); ?> Test deposit</dt>
                    <dd>$20 · Interac e-Transfer</dd>
                </div>
                <div class="hp-glance__row">
                    <dt><?php echo ontariogamers_icon('shield'); ?> Casinos tested</dt>
                    <dd>6 AGCO-licensed</dd>
                </div>
                <div class="hp-glance__row hp-glance__row--good">
                    <dt><?php echo ontariogamers_icon('clock'); ?> Fastest payout</dt>
                    <dd>bet365 · 1h 42m</dd>
                </div>
                <div class="hp-glance__row hp-glance__row--slow">
                    <dt><?php echo ontariogamers_icon('clock'); ?> Slowest payout</dt>
                    <dd>BetMGM · 6h 15m</dd>
                </div>
            </dl>
            <a href="#top-6" class="hp-glance__link">See all payout times <?php echo ontariogamers_icon('arrow'); ?></a>
        </aside>
    </div>
</section>

<!-- ═════════════════════════ JUMP NAV ═════════════════════════ -->
<nav class="hp-jump" aria-label="On this page">
    <div class="hp-wrap">
        <ul class="hp-jump__list">
            <li><a href="#top-6">Top 6</a></li>
            <li><a href="#how-we-test">How We Test</a></li>
            <li><a href="#reviews">Reviews</a></li>
            <li><a href="#legal">Is It Legal?</a></li>
            <li><a href="#how-to-choose">How to Choose</a></li>
            <li><a href="#responsible-gambling">Responsible Gambling</a></li>
            <li><a href="#faq">FAQs</a></li>
        </ul>
    </div>
</nav>

<!-- ═════════════════════════ QUICK COMPARISON ═════════════════════════ -->
<section id="top-6" class="hp-section" aria-labelledby="hp-compare-title">
    <div class="hp-wrap">
        <header class="hp-section__head">
            <p class="hp-eyebrow">Quick comparison</p>
            <h2 id="hp-compare-title">Top 6 Best Online Casinos Ontario – Quick Comparison – <?php echo esc_html(ontariogamers_top6_date('table_suffix')); ?></h2>
            <p class="hp-section__intro">
                The table below is a good starting point for the 6 brands that we mentioned above. From our independent
                hands-on tests on real money online casino Ontario, we came up with the following information regarding
                the top 6 best online casinos in that province.
            </p>
        </header>

        <div class="hp-table-wrap">
            <table class="hp-table">
                <caption class="screen-reader-text">Top 6 Ontario online casinos compared by tested payout time and rating</caption>
                <thead>
                    <tr>
                        <th scope="col">Casino</th>
                        <th scope="col">Payout Time (Tested)</th>
                        <th scope="col">Rating</th>
                        <th scope="col"><span class="screen-reader-text">Play</span></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($table_brands as $b) : ?>
                        <tr class="<?php echo $b['badge'] ? 'is-featured' : ''; ?>">
                            <th scope="row" class="hp-table__casino">
                                <?php echo ontariogamers_top6_logo($b, 'sm'); ?>
                                <span class="hp-table__name">
                                    <?php echo esc_html($b['name']); ?>
                                    <?php if ($b['badge']) : ?>
                                        <span class="hp-badge"><?php echo ontariogamers_icon('clock'); ?><?php echo esc_html($b['badge']); ?></span>
                                    <?php endif; ?>
                                    <a href="#review-<?php echo esc_attr($b['slug']); ?>" class="hp-table__more">Read our test</a>
                                </span>
                            </th>
                            <td data-label="Payout time (tested)">
                                <span class="hp-table__payout"><?php echo ontariogamers_icon('clock'); ?><?php echo esc_html($b['payout']); ?></span>
                                <?php if ($b['payout_note']) : ?>
                                    <span class="hp-table__note">(<?php echo esc_html($b['payout_note']); ?>)</span>
                                <?php endif; ?>
                            </td>
                            <td data-label="Rating">
                                <span class="hp-score"><strong><?php echo esc_html($b['rating']); ?></strong>/10</span>
                                <span class="hp-meter" aria-hidden="true"><span style="width:<?php echo esc_attr((float) $b['rating'] * 10); ?>%"></span></span>
                            </td>
                            <td class="hp-table__cta">
                                <?php echo ontariogamers_top6_play_link($b, 'Play'); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <p class="hp-fineprint">
            19+ · Ontario only · AGCO-licensed operators · T&amp;Cs apply. OntarioGamers.ca earns commission when you sign up through some of our links — at no extra cost to you. This never changes our test results.
        </p>
    </div>
</section>

<!-- ═════════════════════════ HOW WE TEST ═════════════════════════ -->
<section id="how-we-test" class="hp-section hp-section--alt" aria-labelledby="hp-test-title">
    <div class="hp-wrap hp-wrap--narrow">
        <header class="hp-section__head">
            <p class="hp-eyebrow">Methodology</p>
            <h2 id="hp-test-title">How We Test Ontario Casinos</h2>
        </header>

        <p>
            There is more than a big welcome bonus when it comes to selecting an online casino. In the case of
            OntarioGamers.ca, we are trying to help our readers comprehend what a casino is offering, what terms it has,
            and what to look at before depositing money. We normally pay attention to the details that make a real
            difference – from regulatory status and game selection to payment rules and responsible gambling tools.
        </p>
        <p>
            Additionally, we believe that a useful review ought to show its work. Here, we normally distinguish
            information confirmed on official websites from the results that need hands-on testing. Unlike other sites,
            we do not invent player experiences, payout times, or even ratings so as to make a casino look better than
            its peers. During the testing process, this is what we do:
        </p>

        <ol class="hp-steps">
            <li class="hp-step">
                <span class="hp-step__num" aria-hidden="true">1</span>
                <div class="hp-step__body">
                    <h3>We Check Ontario Registration</h3>
                    <p>
                        Before reviewing a casino, we normally check if it is approved to operate in Ontario. To make this
                        possible, we normally use the official iGaming Ontario directory so as to find the casino’s website.
                        Also, we read its terms so as to understand who can register and the rules players need to follow.
                    </p>
                    <p>
                        This step is really helpful as it helps separate regulated casinos from sites that might not be
                        approved to operate in Ontario. If anything, a well-known name or an attractive bonus is not an
                        indication that a casino is licensed per se. Having said that, players need to be at least 19 years
                        old and be located in Ontario for them to use regulated online gambling sites.
                    </p>
                </div>
            </li>
            <li class="hp-step">
                <span class="hp-step__num" aria-hidden="true">2</span>
                <div class="hp-step__body">
                    <h3>We Review Deposits and Payment Options</h3>
                    <p>The next thing we do is to check the official cashier and payment information. We look for features like:</p>
                    <ul class="hp-checks hp-checks--grid">
                        <li><?php echo ontariogamers_icon('check'); ?> Supported payment methods</li>
                        <li><?php echo ontariogamers_icon('check'); ?> Deposit limits</li>
                        <li><?php echo ontariogamers_icon('check'); ?> Withdrawal options</li>
                        <li><?php echo ontariogamers_icon('check'); ?> Any fees or restrictions explained in the terms</li>
                    </ul>
                    <p>
                        For instance, Interac e-Transfer can be available at some casinos. However, we cannot assume that
                        every site supports it. Where a real deposit test is conducted, we record the amount, method, date and
                        confirmation time. Any screenshots used in the published review need to be genuine. They should also
                        have dates and be edited to remove personal financial information.
                    </p>
                </div>
            </li>
            <li class="hp-step">
                <span class="hp-step__num" aria-hidden="true">3</span>
                <div class="hp-step__body">
                    <h3>We Explore the Games</h3>
                    <p>
                        The other element that we check is the games available at the casino. Here, we check games like slots,
                        table games, and live dealer options. When hands-on testing is possible, we record the titles played,
                        and note practical details like loading performance, navigation, and mobile usability. We avoid
                        treating a published game count as permanent. This is because catalogues change. As a result, we
                        check the casino’s current Ontario lobby and record when the information was collected.
                    </p>
                </div>
            </li>
            <li class="hp-step">
                <span class="hp-step__num" aria-hidden="true">4</span>
                <div class="hp-step__body">
                    <h3>We Measure Withdrawals Properly</h3>
                    <p>
                        Withdrawal speeds cannot be overlooked. For this reason, we do not guess it. During our tests, we
                        record the moment a withdrawal has been requested. Also, we record when the casino processes it and
                        the moment funds arrive. Moreover, we note the payment method and whether additional verification
                        was needed.
                    </p>
                    <p>
                        Remember that a single transaction cannot establish a casino’s typical payout speed. We distinguish a
                        casino’s processing time from the time taken by a payment provider or bank. If we have not completed
                        a withdrawal test, we declare it, instead of publishing invented time.
                    </p>
                </div>
            </li>
            <li class="hp-step">
                <span class="hp-step__num" aria-hidden="true">5</span>
                <div class="hp-step__body">
                    <h3>We Assess the Overall Experience</h3>
                    <p>
                        Lastly, we review bonus conditions, account rules, customer support and responsible gambling tools.
                        We look for clear explanations of wagering requirements. Also, we check if there is accessible help
                        as well as options like spending limits, breaks, time limits and self-exclusions.
                    </p>
                    <p>
                        Our goal is to give readers sufficient information so as to compare their options without much
                        pressure. We publish personal testing claims only when they are supported by actual testing records.
                        Further, we update time-sensitive details whenever they change.
                    </p>
                </div>
            </li>
        </ol>
    </div>
</section>

<!-- ═════════════════════════ 6 REVIEWS ═════════════════════════ -->
<section id="reviews" class="hp-section" aria-labelledby="hp-reviews-title">
    <div class="hp-wrap hp-wrap--mid">
        <header class="hp-section__head">
            <p class="hp-eyebrow">In-depth reviews</p>
            <h2 id="hp-reviews-title">The 6 Best Online Casinos in Ontario Reviewed</h2>
            <p class="hp-section__intro">
                The 6 best online casinos Ontario are worth comparing because their brands and products offer different
                starting points for Ontario players. Our team conducted exhaustive, firsthand testing of the regulated
                iGaming market over a 48-hour window. We deposited a fixed baseline of $20 using Interac at each site.
                Also, we actively played real-money slots and immediately requested a withdrawal back to our bank accounts
                through Interac e-Transfer. The following are the 6 best Ontario online casinos.
            </p>
        </header>

        <?php $rank = 0; foreach ($brands as $b) : $rank++; ?>
            <article id="review-<?php echo esc_attr($b['slug']); ?>" class="hp-review" aria-labelledby="hp-review-<?php echo esc_attr($b['slug']); ?>">
                <header class="hp-review__head">
                    <span class="hp-review__rank" aria-hidden="true"><?php echo (int) $rank; ?></span>
                    <?php echo ontariogamers_top6_logo($b, 'lg'); ?>
                    <div class="hp-review__titles">
                        <h3 id="hp-review-<?php echo esc_attr($b['slug']); ?>"><?php echo (int) $rank; ?>. <?php echo esc_html($b['title']); ?></h3>
                        <p class="hp-review__bestfor"><strong>Best for:</strong> <?php echo esc_html($b['best_for']); ?></p>
                    </div>
                    <div class="hp-review__score" aria-label="Rating <?php echo esc_attr($b['rating']); ?> out of 10">
                        <strong><?php echo esc_html($b['rating']); ?></strong><span>/10</span>
                    </div>
                </header>

                <dl class="hp-facts">
                    <div class="hp-fact hp-fact--payout">
                        <dt><?php echo ontariogamers_icon('clock'); ?> Payout tested</dt>
                        <dd>
                            <strong><?php echo esc_html($b['payout']); ?></strong>
                            <?php if ($b['payout_via']) : ?> <?php echo esc_html($b['payout_via']); ?><?php endif; ?>
                            <?php if ($b['payout_note']) : ?><span class="hp-fact__note">(<?php echo esc_html($b['payout_note']); ?>)</span><?php endif; ?>
                        </dd>
                    </div>
                    <div class="hp-fact">
                        <dt><?php echo ontariogamers_icon('game'); ?> Games tested</dt>
                        <dd><?php echo esc_html($b['games']); ?></dd>
                    </div>
                    <div class="hp-fact">
                        <dt><?php echo ontariogamers_icon('gift'); ?> Bonus &amp; terms</dt>
                        <dd><?php echo esc_html($b['bonus']); ?></dd>
                    </div>
                </dl>

                <div class="hp-proscons">
                    <div class="hp-pro">
                        <h4><?php echo ontariogamers_icon('check'); ?> Why we like it</h4>
                        <p><?php echo esc_html($b['why']); ?></p>
                    </div>
                    <div class="hp-con">
                        <h4><?php echo ontariogamers_icon('alert'); ?> Drawback</h4>
                        <p><?php echo esc_html($b['drawback']); ?></p>
                    </div>
                </div>

                <?php if ($b['shot_html']) : ?>
                    <figure class="hp-shot">
                        <?php echo $b['shot_html']; ?>
                        <?php if ($b['shot_caption']) : ?>
                            <figcaption><?php echo esc_html($b['shot_caption']); ?></figcaption>
                        <?php endif; ?>
                    </figure>
                <?php endif; ?>

                <footer class="hp-review__foot">
                    <?php echo ontariogamers_top6_play_link($b, $b['cta'], 'hp-btn hp-btn--play hp-btn--lg'); ?>
                    <?php if ($b['review_url']) : ?>
                        <a href="<?php echo esc_url($b['review_url']); ?>" class="hp-btn hp-btn--outline">Read full review</a>
                    <?php endif; ?>
                    <span class="hp-review__terms">19+ · Ontario only · T&amp;Cs apply · Play responsibly</span>
                </footer>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<!-- ═════════════════════════ LEGALITY ═════════════════════════ -->
<section id="legal" class="hp-section hp-section--alt" aria-labelledby="hp-legal-title">
    <div class="hp-wrap hp-wrap--narrow">
        <header class="hp-section__head">
            <p class="hp-eyebrow">The law</p>
            <h2 id="hp-legal-title">Is Online Gambling Legal in Ontario?</h2>
        </header>

        <p class="hp-answer"><strong>Yes.</strong> Ontario has a regulated online gambling market, where eligible adults can play online via approved private online gambling websites. The province's regulated market opened in April 2022, providing a structure for private operators to provide online casino games and other gaming products.</p>

        <ul class="hp-stats" aria-label="Ontario market facts">
            <li><strong>April 2022</strong><span>Regulated market opened</span></li>
            <li><strong>49</strong><span>Operators</span></li>
            <li><strong>84</strong><span>Gaming websites</span></li>
            <li><strong>19+</strong><span>Minimum age</span></li>
        </ul>
        <p class="hp-stats__src">Operator and website counts per iGaming Ontario’s official directory, as of September 1, 2026.</p>

        <p>
            When it comes to regulating online gaming in Ontario, that activity is regulated by the Alcohol and Gaming
            Commission of Ontario (AGCO). iGaming Ontario, on the other hand, contracts with eligible operators to conduct
            and manage regulated online gaming. The provincial framework also includes the Ontario Lottery and Gaming
            Corporation – it operates OLG.ca separately from the private-operator model.
        </p>

        <div class="hp-orgs">
            <a class="hp-org" href="https://www.agco.ca/" target="_blank" rel="noopener">
                <strong>AGCO</strong><span>Regulates online gaming in Ontario</span>
            </a>
            <a class="hp-org" href="https://igamingontario.ca/" target="_blank" rel="noopener">
                <strong>iGaming Ontario</strong><span>Contracts with eligible private operators</span>
            </a>
            <a class="hp-org" href="https://www.olg.ca/" target="_blank" rel="noopener">
                <strong>OLG</strong><span>Operates OLG.ca separately</span>
            </a>
        </div>

        <p>
            According to iGaming Ontario’s official directory, the market included 49 operators and 84 gaming websites as
            of September 1, 2026. Notably, these figures can change as operators and websites enter and leave the Ontario
            market. Therefore, as a player, you will not miss legal online casinos Ontario.
        </p>
    </div>
</section>

<!-- ═════════════════════════ HOW TO CHOOSE ═════════════════════════ -->
<section id="how-to-choose" class="hp-section" aria-labelledby="hp-choose-title">
    <div class="hp-wrap hp-wrap--narrow">
        <header class="hp-section__head">
            <p class="hp-eyebrow">Buyer’s guide</p>
            <h2 id="hp-choose-title">How to Choose an Ontario Online Casino</h2>
        </header>

        <p>
            Comparing online casinos is not a complicated process. For optimal results, start with the basic checks.
            After that, look at the features that are of importance to you. A good comparison puts safety, clarity and
            convenience ahead of promotional claims. These are the features you should check when choosing an Ontario
            online casino.
        </p>

        <div class="hp-guide">
            <div class="hp-guide__icon"><?php echo ontariogamers_icon('search'); ?></div>
            <div>
                <h3>Always Check the AGCO and iGaming Ontario Listing</h3>
                <p>
                    The first step is to verify the site’s regulatory status. For starters, Ontario’s private regulated
                    market involves AGCO regulation and agreements with iGaming Ontario. Therefore, to be safe, look at the
                    exact website and not just the brand name. In case a site uses a different domain or redirects you to
                    another website, that is a red flag.
                </p>
                <p>You should also take time to review the site’s terms. Ideally, these terms should explain the following:</p>
                <ul class="hp-checks hp-checks--grid">
                    <li><?php echo ontariogamers_icon('check'); ?> Eligibility</li>
                    <li><?php echo ontariogamers_icon('check'); ?> Account verification</li>
                    <li><?php echo ontariogamers_icon('check'); ?> Payment rules</li>
                    <li><?php echo ontariogamers_icon('check'); ?> How disputes are handled</li>
                </ul>
                <p>
                    Regulatory status does not mean that you’ll win money or that every transaction will be immediate.
                    Instead, it means that the operator is part of the applicable regulated framework. For this reason, you
                    need to read the rules and make careful decisions.
                </p>
            </div>
        </div>

        <div class="hp-guide">
            <div class="hp-guide__icon"><?php echo ontariogamers_icon('card'); ?></div>
            <div>
                <h3>Compare Interac and Other Payment Methods</h3>
                <p>
                    One thing you ought to know is that payment options can affect how convenient an online casino is to
                    use. Some Canadian-facing casino sites advertise Interac e-Transfer, while others offer different card,
                    bank, or electronic payment options.
                </p>
                <p>The available methods depend on the casino you choose and your account. For safety, confirm these details before you deposit any money:</p>
                <dl class="hp-defs">
                    <div><dt>Minimum deposits</dt><dd>Check the least amount of money you can deposit.</dd></div>
                    <div><dt>Withdrawal availability</dt><dd>Confirm that your desired method supports not only deposits but also withdrawals.</dd></div>
                    <div><dt>Processing rules</dt><dd>Find out if the casino needs to approve the transaction before payment is sent.</dd></div>
                    <div><dt>Verification</dt><dd>Check if identification or additional account information is needed.</dd></div>
                </dl>
                <p class="hp-callout">
                    More importantly, do not deposit more money so as to meet a promotional threshold. Instead, you should
                    deposit an amount that fits your entertainment budget and skip the offer if its conditions do not
                    really suit you.
                </p>
            </div>
        </div>

        <div class="hp-guide">
            <div class="hp-guide__icon"><?php echo ontariogamers_icon('clock'); ?></div>
            <div>
                <h3>Payout Speed Matters More Than a Large Bonus</h3>
                <p>
                    At first glance, a large advertised bonus can look attractive – however, the terms involved determine
                    how it works. For instance, some promotions need a player to wager a specified amount before the
                    promotional funds or related wins can be withdrawn.
                </p>
                <p>
                    Withdrawal speeds also need careful interpretation – the duration a site takes to process payments
                    might not necessarily include the time taken by a bank or payment provider to complete the transfer.
                </p>
                <p>
                    As you compare casinos, look for clear withdrawal rules and independently documented results. You
                    should refrain from relying on an unsupported claim that a casino pays everyone within a certain
                    number of minutes. In case no reliable test has been published, treat the payout time as unknown.
                    Sometimes, it is good to have an honest comparison rather than a precise number with no evidence
                    behind it.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- ═════════════════════════ RESPONSIBLE GAMBLING ═════════════════════════ -->
<section id="responsible-gambling" class="hp-section hp-section--rg" aria-labelledby="hp-rg-title">
    <div class="hp-wrap hp-wrap--narrow">
        <header class="hp-section__head">
            <p class="hp-eyebrow">Play safe</p>
            <h2 id="hp-rg-title">Responsible Gambling Ontario</h2>
        </header>

        <p>
            First and foremost, online gambling ought to be treated as paid entertainment and not as a source of income.
            This is because casino games involve chances of losing money. Additionally, no bonus, strategy, or betting
            system can guarantee a profit. This is where responsible gambling in Ontario comes in.
        </p>
        <p>
            As a player, before you start playing, ensure that you decide how much money and time you really want to
            spend – set a budget and avoid borrowing money so that you can gamble. In addition, avoid chasing losses by
            increasing your stakes.
        </p>
        <p>
            Where possible, ensure that you take breaks – if gambling begins to affect your finances, relationship,
            sleep or daily responsibilities. You can also use responsible gambling tools available through your casino
            account, including:
        </p>

        <ul class="hp-tools">
            <li><?php echo ontariogamers_icon('wallet'); ?> Deposit limits</li>
            <li><?php echo ontariogamers_icon('pause'); ?> Time-outs</li>
            <li><?php echo ontariogamers_icon('stop'); ?> Self-exclusion</li>
        </ul>

        <h3>Where can Ontario players get help?</h3>
        <div class="hp-help">
            <div class="hp-help__card hp-help__card--primary">
                <strong>ConnexOntario</strong>
                <p>Offers free, confidential information and referrals to gambling treatment and support services.</p>
                <a href="tel:18665312600" class="hp-help__phone"><?php echo ontariogamers_icon('phone'); ?> 1-866-531-2600</a>
                <a href="https://www.connexontario.ca/" target="_blank" rel="noopener" class="hp-help__link">Visit website</a>
            </div>
            <div class="hp-help__card">
                <strong>Alcohol and Gaming Commission of Ontario</strong>
                <p>Offers regulatory information about Ontario’s gambling industry.</p>
                <a href="https://www.agco.ca/" target="_blank" rel="noopener" class="hp-help__link">agco.ca</a>
            </div>
            <div class="hp-help__card">
                <strong>iGaming Ontario</strong>
                <p>Provides information about the regulated online gaming market and player resources.</p>
                <a href="https://igamingontario.ca/" target="_blank" rel="noopener" class="hp-help__link">igamingontario.ca</a>
            </div>
            <div class="hp-help__card">
                <strong>BetGuard</strong>
                <p>Ontario’s centralized self-exclusion tool that allows eligible adults to opt out of regulated online gaming platforms through one portal.</p>
            </div>
        </div>

        <p>
            As a player based in Ontario, seeking help is a sensible step anytime you feel like you have started to
            grapple with problem gambling. You do not have to wait until a problem becomes chronic for you to contact
            the support services mentioned above.
        </p>
    </div>
</section>

<!-- ═════════════════════════ FAQ ═════════════════════════ -->
<section id="faq" class="hp-section" aria-labelledby="hp-faq-title">
    <div class="hp-wrap hp-wrap--narrow">
        <header class="hp-section__head">
            <p class="hp-eyebrow">FAQs</p>
            <h2 id="hp-faq-title">FAQs – Best Online Casinos Ontario</h2>
        </header>

        <div class="hp-faq">
            <?php foreach (ontariogamers_home_faqs() as $i => $faq) : ?>
                <details class="hp-faq__item"<?php echo 0 === $i ? ' open' : ''; ?>>
                    <summary><h3><?php echo (int) ($i + 1); ?>. <?php echo esc_html($faq['q']); ?></h3></summary>
                    <div class="hp-faq__a"><p><?php echo esc_html($faq['a']); ?></p></div>
                </details>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ═════════════════════════ MORE REVIEWS ═════════════════════════ -->
<?php
$hp_more = new WP_Query(array(
    'post_type'      => 'casino_review',
    'posts_per_page' => 6,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'no_found_rows'  => true,
));
if ($hp_more->have_posts()) :
    ?>
    <section class="hp-section hp-section--alt" aria-labelledby="hp-more-title">
        <div class="hp-wrap hp-wrap--mid">
            <header class="hp-section__head">
                <p class="hp-eyebrow">Explore</p>
                <h2 id="hp-more-title">More Ontario Casino Reviews</h2>
            </header>

            <?php
            while ($hp_more->have_posts()) : $hp_more->the_post();
                $rating     = get_post_meta(get_the_ID(), 'casino_rating', true);
                $affiliate  = get_post_meta(get_the_ID(), 'casino_affiliate_url', true);
                $withdrawal = get_post_meta(get_the_ID(), 'casino_withdrawal_time', true);
                ?>
                <div class="hp-mini">
                    <div class="hp-mini__logo"><?php echo ontariogamers_casino_logo_linked('casino-logo', 'casino-logo'); ?></div>
                    <div class="hp-mini__info">
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <p class="hp-mini__meta">
                            <?php if ($rating) : ?><span><?php echo ontariogamers_icon('star'); ?><?php echo esc_html($rating); ?>/10</span><?php endif; ?>
                            <?php if ($withdrawal) : ?><span><?php echo ontariogamers_icon('clock'); ?>Withdrawal: <?php echo esc_html($withdrawal); ?></span><?php endif; ?>
                        </p>
                    </div>
                    <div class="hp-mini__cta">
                        <a href="<?php the_permalink(); ?>" class="hp-btn hp-btn--outline hp-btn--sm">Review</a>
                        <?php if ($affiliate) : ?>
                            <a href="<?php echo esc_url($affiliate); ?>" class="hp-btn hp-btn--play hp-btn--sm" target="_blank" rel="<?php echo esc_attr(ontariogamers_aff_rel()); ?>">Play</a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
            ?>

            <p class="hp-fineprint">New players only. 19+. Ontario players: bonus terms cannot be publicly displayed under AGCO Standard 11.10 — see offer directly at operator. Always read full T&amp;Cs before claiming. Wagering requirements apply.</p>

            <p class="hp-center">
                <a href="<?php echo esc_url(home_url('/online-casinos/')); ?>" class="hp-btn hp-btn--outline">View every casino review <?php echo ontariogamers_icon('arrow'); ?></a>
            </p>
        </div>
    </section>
<?php endif; ?>

<!-- ═════════════════════════ LATEST NEWS ═════════════════════════ -->
<?php
$news = new WP_Query(array(
    'post_type'           => 'post',
    'posts_per_page'      => 3,
    'ignore_sticky_posts' => true,
    'no_found_rows'       => true,
));
if ($news->have_posts()) :
    ?>
    <section class="hp-section" aria-labelledby="hp-news-title">
        <div class="hp-wrap">
            <header class="hp-section__head">
                <p class="hp-eyebrow">News</p>
                <h2 id="hp-news-title">Latest Ontario Gambling News</h2>
            </header>
            <div class="news-grid">
                <?php
                while ($news->have_posts()) : $news->the_post();
                    get_template_part('template-parts/news', 'card');
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
            <p class="hp-center">
                <a href="<?php echo esc_url(home_url('/news/')); ?>" class="hp-btn hp-btn--outline">Read all news <?php echo ontariogamers_icon('arrow'); ?></a>
            </p>
        </div>
    </section>
<?php endif; ?>

<div class="hp-wrap hp-disclaimer"><?php ontariogamers_disclaimer(); ?></div>

</main>

<?php get_footer(); ?>
