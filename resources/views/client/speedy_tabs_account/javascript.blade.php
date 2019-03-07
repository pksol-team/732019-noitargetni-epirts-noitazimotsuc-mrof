<?php $get_data = $_GET ?>
<script type="text/javascript">
    var settings = JSON.parse('<?php echo  str_replace("'","",json_encode($settings)) ?>');
    var checked = jQuery("input[name='academic_id']:checked").val();
    var rate = null;
    var initial_rate = '{{ @$get_data['rate_id'] }}';
    function setAcademicId(id){
        var initial_rate = '{{ @$get_data['rate_id'] }}';
        setAcademic(id,initial_rate);
    }
    jQuery(document).ready(function(){
//       setAcademicInput();
    });

    function setAcademicInput(){
        var id = jQuery("select[name='academic_id']").val();
        setAcademicId(id);
        var initial_rate = '{{ @$get_data['rate_id'] }}';
        if(initial_rate){
            alert(initial_rate);
            jQuery("select[name='rate_id']").val(initial_rate);
        }
    }

    function setStyleInput(){
        var id = jQuery("select[name='style_id']").val();
        changeStyle(id);
    }

    function changeStyle(id){
        jQuery("input[name='style_id']").val(id);
        jQuery(".style_button").removeClass('active')
        jQuery("#style_no_"+id).addClass('active');

    }

    function addPages(){
        var pages = jQuery("input[name='pages']").val();
        pages =  parseInt(pages) || 0;
        pages++;
        jQuery("input[name='pages']").val(pages);
        countWords();
    }

    function minusPages(){
        var pages = jQuery("input[name='pages']").val();
        pages =  parseInt(pages) || 1;
        if(pages>1){
            pages--;
        }
        var words = 275*pages;
        jQuery("input[name='pages']").val(pages);
        countWords();
    }
    function addSources(){
        var sources = jQuery("input[name='sources']").val();
        sources =  parseInt(sources);
        if(sources<1)
            sources = 0;
        sources++;
        jQuery("input[name='sources']").val(sources);
    }

    function formatPages(){
        var pages = jQuery("input[name='pages']").val();
        pages =  parseInt(pages) || 1;
        var words = 275*pages;
        jQuery("#words_total_qty").html(words);
        jQuery("input[name='pages']").val(pages);
        countWords();
    }

    function minusSources(){
        var sources = jQuery("input[name='sources']").val();
        sources =  parseInt(sources) || 0;
        if(sources>0){
            sources--;
        }
        jQuery("input[name='sources']").val(sources);
    }

    function stepOne(){
        jQuery(".uvoform_nav_tab").removeClass('ui-state-active');
        jQuery(".uvoform_nav_tab").removeClass('ui-tab-active');
        jQuery("#li_tab_services").addClass('ui-tab-active');
        jQuery("#li_tab_services").addClass('ui-state-active');
        jQuery("#tab_price").slideUp();
        jQuery("#tab_services").slideDown();
        jQuery("#tab_personal").slideUp();
        return false;
    }
    function stepTwo(){
        jQuery(".uvoform_nav_tab").removeClass('ui-state-active');
        jQuery(".uvoform_nav_tab").removeClass('ui-tab-active');
        jQuery("#li_tab_price").addClass('ui-tab-active');
        jQuery("#li_tab_price").addClass('ui-state-active');
        jQuery("#tab_services").slideUp();
        jQuery("#tab_personal").slideUp();
        jQuery("#tab_price").slideDown();
        return false;
    }

    function stepThree(){
        jQuery(".uvoform_nav_tab").removeClass('ui-state-active');
        jQuery(".uvoform_nav_tab").removeClass('ui-tab-active');
        jQuery("#li_tab_payment").addClass('ui-tab-active');
        jQuery("#li_tab_payment").addClass('ui-state-active');
        jQuery("#tab_price").slideUp();
        jQuery("#tab_services").slideUp();
        jQuery("#tab_personal").slideDown();
        return false;
    }

    function setAcademic(id,initial_rate){
//        alert(initial_rate);
        jQuery("select[name='rate_id']").html('');
        var academics = this.settings.academics;
        var rates = this.settings.rates;
        var selected = 0;
        for(var i =0;i<rates.length;i++){
            var rate = rates[i];
            if(rate.academic_id==id && rate.deleted==0){
                jQuery("select[name='rate_id']").append('<option value="'+rate.id+'">'+rate.label+'</option>');
                if(selected==0){
                    selected = 1;
                    jQuery("#deadlines").append(getCheckedRateString(rate));
                }else{
                    jQuery("#deadlines").append(getRateString(rate));
                }
            }
        }
        if(initial_rate){
            jQuery("select[name='rate_id']").val(initial_rate);
        }
        getOrderCost();
    }

    function setPaymentMethod(id){
        jQuery("select[name='payment_method']").val(id);
        jQuery("#payment_method_"+id).attr('checked','checked');
        jQuery(".payment_lbl").removeClass('ui-state-active');
        jQuery("#payment_label_"+id).addClass('ui-state-active');
    }

    function getCheckedRateString(rate){
        var str = '<input checked="checked" class="ui-helper-hidden-accessible deadline_radio" id="radio_deadline_'+rate.id+'"'+
            'name="deadline" value="'+rate.id+'"  type="radio"><label'+
            'aria-pressed="true" onclick="changeRate('+rate.id+')" aria-disabled="false" role="button"'+
            'class="ui-button ui-state-active ui-widget deadline_label ui-state-default ui-button-text-only" for="radio_deadline_'+rate.id+'"'+
            'id="tip_radio_deadline_'+rate.id+'"><span'+
            'class="ui-button-text">'+rate.label+'</span></label>';
        return str;
    }

    function getRateString(rate){
        var str = '<input class="ui-helper-hidden-accessible deadline_radio" id="radio_deadline_'+rate.id+'"'+
            'name="deadline" value="'+rate.id+'"  type="radio"><label'+
            'aria-pressed="false" onclick="changeRate('+rate.id+')" aria-disabled="false" role="button"'+
            'class="ui-button ui-widget ui-state-default deadline_label ui-button-text-only" for="radio_deadline_'+rate.id+'"'+
            'id="tip_radio_deadline_'+rate.id+'"><span'+
            'class="ui-button-text">'+rate.label+'</span></label>';
        return str;
    }

    function changeRate(id){
        jQuery("select[name='rate_id']").val(id);
        jQuery("#radio_deadline_"+id).attr('checked','checked');
        jQuery(".deadline_label").removeClass('ui-state-active');
        jQuery("#tip_radio_deadline_"+id).addClass('ui-state-active');
        getOrderCost();
    }

    function setSelectedRate(){
        var id = jQuery("select[name='rate_id']").val();
        changeRate(id);
    }

    function selectSingle(){
        jQuery(".double-spacing").removeClass('active');
        jQuery(".single-spacing").addClass('active');
        jQuery("input[name='spacing']").val(1);
        countWords();
    }

    function selectDouble(){
        jQuery(".single-spacing").removeClass('active');
        jQuery(".double-spacing").addClass('active');
        jQuery("input[name='spacing']").val(2);
        countWords();
    }

    function changeSpacing(){
        var spacing = jQuery("select[name='spacing']").val();
        if(spacing==2){
            selectDouble();
        }else{
            selectSingle();
        }
        countWords();
    }

    function countWords(){
        var spacing = jQuery("input[name='spacing']").val();
        var pages = jQuery("input[name='pages']").val();
        var partial = '{{ @$_GET['partial'] }}';
        if(partial <1 && pages>=10){
            jQuery(".progressive_input").removeAttr('disabled');
            console.log('enabled progress');
        }
        if(partial > 0 || pages<10){
            var id = jQuery(".progressive_input").val();
            var index = this.featured.indexOf(id);
            this.featured.splice(index,1);
            jQuery('#feature_'+id).prop('checked', false);
            jQuery(".progressive_input").attr('disabled',true);
            console.log('Disabled progress');
        }


        pages = parseInt(pages)||1;
        spacing = parseInt(spacing)||2;
        var multi = 1;
        if(spacing==1){
            multi = 2;
        }
        var words = 275*multi*pages;
        jQuery("#words_total_qty").html(words);
        getOrderCost();
    }

    function setWriterCategory(id){
        jQuery(".writer-categories").removeClass('active');
        jQuery("#writer_category_"+id).addClass('active');
        jQuery("input[name='writer_category_id']").val(id);
        getOrderCost();
    }

    function changeWriterCategory(){
        var cat_id = jQuery("select[name='writer_category_id']").val();
        setWriterCategory(cat_id);
    }

    jQuery(document).ready(function(){
        var id = jQuery("select[name='academic_id']").val();
        setAcademicId(id);
        formatPages();
        jQuery(".chosen-select").chosen({disable_search_threshold: 10});
        jQuery(".chosen-container").width('100%');
    });



    function getRate(){
        var rate_id =  jQuery("select[name='rate_id']").val();
        var rates = this.settings.rates;
        var found = null;
        for(var i=0;i<rates.length;i++){
            var rate = rates[i];
            if(rate.id==rate_id){
                found = rate;
                break;
            }
        }
//            console.log(found);
        return found;
    }
    var featured = [];
    function changeFeatured(id){
        var checked = jQuery('#feature_'+id).is(':checked');
        if(checked==true){
            var index = this.featured.indexOf(id);
            this.featured.splice(index,1);
            jQuery('#feature_'+id).prop('checked', false);
        }else{
            jQuery('#feature_'+id).prop('checked', true);
            this.featured.push(id);
        }
        getOrderCost();
    }

    function getFeature(id){
        var additional_features = this.settings.additional_features;
        var featured = this.featured;
        var amt = 0;
        for(var i=0;i<additional_features.length;i++){
            var feature = additional_features[i];
            if(featured.indexOf(feature.id) != -1){
                if(feature.inc_type=='money'){
                    amt+=parseFloat(feature.amount);
                }else{
                    amt+=parseFloat((feature.amount/100)*flat_rate);
                }

            }

        }
    }

    function getFeaturedCost(flat_rate){
        var additional_features = this.settings.additional_features;
        var featured = this.featured;
        var amt = 0;
        for(var i=0;i<additional_features.length;i++){
            var feature = additional_features[i];
            if(featured.indexOf(feature.id) != -1){
                if(feature.inc_type=='money'){
                    amt+=parseFloat(feature.amount);
                }else{
                    amt+=parseFloat((feature.amount/100)*flat_rate);
                }

            }

        }
        return amt;
    }
    function getOrderCost(){
        var pages = jQuery("input[name='pages']").val();
        var spacing_val = jQuery("input[name='spacing']").val();
        var spacing = 1;
        if(spacing_val=='2'){
            spacing = 1
        }else{
            spacing = 2;
        }

        var cpp = getRate().cost;
        var flat_rate = cpp*spacing;
        var subject = getSubject();
        var document = getDocument();
        var language = getLanguage();
        var writer = getWriter();
        var style = getStyle();
        var subject_increase = 0;
        var document_increase = 0;

        /**
         * Calculate increment by document type
         */
        if(document.inc_type=='percent'){
            document_increase = flat_rate*((parseFloat(document.amount))/100);
        }else if(document.inc_type=='money'){
            document_increase = parseFloat(document.amount);
        }


        /**
         * Calculate increment by subject
         */
        if(subject.inc_type=='percent'){
            subject_increase = flat_rate*((parseFloat(subject.amount))/100);
        }else if(subject.inc_type=='money'){
            subject_increase = parseFloat(subject.amount);
        }

        /**
         * Calculate increment by style
         */
        if(style.inc_type=='percent'){
            style_increase = flat_rate*((parseFloat(style.amount))/100);
        }else if(style.inc_type=='money'){
            style_increase = parseFloat(style.amount);
        }

        /**
         * Calculate increment by language
         */
        if(language.inc_type=='percent'){
            language_increase = flat_rate*((parseFloat(language.amount))/100);
        }else if(language.inc_type=='money'){
            language_increase = parseFloat(language.amount);
        }

        /**
         * Calculate increment by writer
         */
        if(writer.inc_type=='percent'){
            writer_increase = flat_rate*((parseFloat(writer.amount))/100);
        }else if(writer.inc_type=='money'){
            writer_increase = parseFloat(writer.amount);
        }

        var total_cost = (flat_rate+subject_increase+document_increase+language_increase+style_increase+writer_increase)*pages;
        var featured_amt = getFeaturedCost(total_cost);
        total_cost+=featured_amt;
        jQuery(".total_price_box_full").html("$"+total_cost.toFixed(2));
        var deposit_rate = parseFloat('{{ @$website->deposit/100 }}');
        jQuery(".deposit_amt").html("$"+(total_cost*deposit_rate).toFixed(2)+' of $'+total_cost.toFixed(2)+'');
        jQuery("input[name='total_price']").val(total_cost.toFixed(2));
        changeCurrency();
    }

    function getSubject(){
        var subject_id = jQuery("select[name='subject_id']").val();
        var subjects = this.settings.subjects;
        var found = null;
        for(var i=0;i<subjects.length;i++){
            var subject = subjects[i];
            if(subject.id==subject_id){
                found = subject;
                break;
            }
        }
        return found;
    }
    function getWriter(){
        var id = jQuery("input[name='writer_category_id']").val();
        var writer_categories = this.settings.writer_categories;
        var writer = null;
        for(var i =0; i<writer_categories.length;i++){
            if(writer_categories[i].id==id){
                writer = writer_categories[i];
            }
        }
        return writer;
    }
    function getDocument(){
        var document_id = jQuery("select[name='document_id']").val();
        var documents = this.settings.documents;
        var found = null;
        for(var i=0;i<documents.length;i++){
            var document = documents[i];
            if(document.id==document_id){
                found = document;
                break;
            }
        }
        return found;
    }

    function getLanguage(){
        var language_id = jQuery("select[name='language_id']").val();
        var languages = this.settings.languages;
        var found = null;
        for(var i=0;i<languages.length;i++){
            var language = languages[i];
            if(language.id==language_id){
                found = language;
                break;
            }
        }
        return found;
    }

    function getStyle(){
        var style_id = jQuery("input[name='style_id']").val();
        var styles = this.settings.styles;
        var found = null;
        for(var i=0;i<styles.length;i++){
            var style = styles[i];
            if(style.id==style_id){
                found = style;
                break;
            }
        }
        return found;
    }
    function changeCurrency(){
        var selected = jQuery("#currency_select").val();
        var original = jQuery("input[name='total_price']").val();
        var currencies = this.settings.currencies;
        for(i=0;i<currencies.length;i++){
            var currency = currencies[i];
            if(currency.id==selected){
                var new_amt = parseFloat(original)*parseFloat(currency.usd_rate);
                jQuery(".total_price_box_full").html(new_amt.toFixed(2)+' '+currency.abbrev);
            }
        }
    }

    function showReturningCustomer(){
        jQuery(".cabinet-tab").removeClass('ui-tabs-active');
        jQuery(".cabinet-tab").removeClass('ui-state-active');
        jQuery("#returning_customer_tab").addClass('ui-state-active ui-tabs-active');
        jQuery("#tabs-2").slideDown();
        jQuery("#tabs-1").slideUp();
        return false;
    }

    function showNewCustomer(){
        jQuery(".cabinet-tab").removeClass('ui-tabs-active');
        jQuery(".cabinet-tab").removeClass('ui-state-active');
        jQuery("#new_customer_tab").addClass('ui-state-active ui-tabs-active');
        jQuery("#tabs-1").slideDown();
        jQuery("#tabs-2").slideUp();
        return false;
    }

    function checkId(){
        var id = jQuery("input[name='order_number']").val();
        var data = {id:id};
        $.get('{{ URL::to("order/check-number") }}',data,function(response){
            if(response == 0){

            }else{
                alert('Order Number has already been taken!');
                jQuery("input[name='order_number']").val('');
            }
        });
    }
    function useCode(){
        getOrderCost();
        $("#responsi").html('Processing...');
        var code = $("#promotion").val();
        var url = "{{ URL::to('promotions/search') }}";
        var total = $("input[name='total_price']").val();
        $.get(url,{code:code,total:total},function(data){
            var response = JSON.parse(data);
            $("#responsi").html('processing.. ');
            if(response.status){
                $("#responsi").html('');
                var total = parseFloat($("input[name='total_price']").val());
                $("input[name='discounted']").val(response.percent);
                var dis = 100-parseInt(response.percent);
                var newtot = dis/100*total;
                $("#final_total").val(newtot);
                $(".total_price_box").html('$'+newtot.toFixed(2));
                $("#pricediv").html('<span class="" style="color:green;font-size:large;">Success! You have been awarded  <span style="color:red;">'+response.percent+'%</span> promotion on your order total.New cost is <span style="color:red;">$'+newtot.toFixed(2)+'</span> from <span style="color:red;">$'+total+'</span></span>')

            }else{
                $("#responsi").html(response.error);
            }
        });
    }
</script>