<script type="text/javascript">
    var settings = JSON.parse('<?php echo  str_replace("'","",json_encode($settings)) ?>');
    var checked = $("select[name='academic_id']").val();
    var rate = null;
    var initial_rate = '{{ @$get_data['rate_id'] }}';
    var featured = [];

    setAcademic(checked);
    if(initial_rate){
        $("input[name='rate_id']").val(initial_rate);
    }
    $(function() {

        $('#subject_field').magicSuggest({
            data:<?php echo  str_replace("'","",json_encode($subjects)) ?>,
            valueField: 'id',
            displayField: 'label',
            maxSelection: 1
        });
        $('#document_field').magicSuggest({
            data:<?php echo  str_replace("'","",json_encode($documents)) ?>,
            valueField: 'id',
            displayField: 'label',
            maxSelection: 1
        });

    });
    function setAcademic(id){
        $("select[name='rate_id']").html('');
        var academics = this.settings.academics;
        var rates = this.settings.rates;
        for(var i =0;i<rates.length;i++){
            var rate = rates[i];
            if(rate.academic_id==id && rate.deleted==0){
                $("select[name='rate_id']").append('<option value="'+rate.id+'">'+rate.label+'</option>');
            }
        }
        getOrderCost();
    }



    function getRate(){
        var rate_id =  $("select[name='rate_id']").val();
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
    function setSpacing(){
        var single_spaced = $("input[name='single_spaced']").is(':checked');
        var pages = $("select[name='pages']").val();
        if(single_spaced){
            $("input[name='spacing']").val(1);
            $(".double-spacing").hide();
            $(".double-spacing").attr('name','pages_single');
            $(".single-spacing").attr('name','pages');
            $(".single-spacing").show();
            $(".single-spacing").val(pages);
        }else{
            $("input[name='spacing']").val(2);
            $(".single-spacing").hide();
            $(".single-spacing").attr('name','pages_single');
            $(".double-spacing").attr('name','pages');
            $(".double-spacing").show();
            $(".double-spacing").val(pages);
        }
        getOrderCost();

    }
    function getOrderCost(){
        console.log($("input[name='feature_ids']"));
        var pages = $("select[name='pages']").val();
        var spacing_val = $("input[name='spacing']").val();
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
            console.log(flat_rate);
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
        featured_cost = getFeaturedCost(flat_rate);

        var total_cost = (flat_rate+subject_increase+document_increase+language_increase+style_increase+writer_increase)*pages;
        total_cost+=featured_cost;
        $("#total_price").val(total_cost.toFixed(2));
        $(".of-total-price").html(total_cost.toFixed(2));
//        changeCurrency();
    }

    function getSubject(){
        var subject_id = $("select[name='subject_id']").val();
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
        var id = $("select[name='writer_category_id']").val();
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
        var document_id = $("select[name='document_id']").val();
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
        var language_id = $("select[name='language_id']").val();
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
        var style_id = $("select[name='style_id']").val();
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
        var selected = $("#currency_select").val();
        var original = $("#total_price").val();
        var currencies = this.settings.currencies;
        for(i=0;i<currencies.length;i++){
            var currency = currencies[i];
            if(currency.id==selected){
                var new_amt = parseFloat(original)*parseFloat(currency.usd_rate);
                $("#foreign_currency").val(new_amt.toFixed(2)+' '+currency.abbrev);
                $("#deposit_amt").val((new_amt*0.3).toFixed(2)+' '+currency.abbrev);
            }
        }
    }

    function changeFeatured(id){
        var checked = jQuery('#feature_'+id).is(':checked');
        if(checked==false){
            var index = this.featured.indexOf(id);
            this.featured.splice(index,1);
            jQuery('#feature_'+id).prop('checked', false);
        }else{
            jQuery('#feature_'+id).prop('checked', true);
            this.featured.push(id);
        }
        getOrderCost();
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
        console.log(amt);
        return amt;
    }
</script>
<script type="text/javascript">
    var telInput = $("input[name='phone']");
    telInput.intlTelInput("loadUtils", "lib/libphonenumber/build/utils.js");
    telInput.intlTelInput();
    telInput.change(function(){
        checkValid();
    });
    function setCountry(){
        var countryData = $("input[name='phone']").intlTelInput("getSelectedCountryData");
        var country = countryData.name+"(+"+countryData.dialCode+")";
        $("input[name='country']").val(country);
    }
    $("#reg_form").submit(function(){
        checkValid();
    });
    function checkValid(){
        setCountry();
//       var phone = $("input[name='phone']").val();
//        if(isNaN(phone) && phone.length<15 && phone.length>6){
//            isValid = true;
//        }else{
//            isValid = false;
//        }
//
//        if(isValid){
//            console.log('valid');
//            $("#phone_group").removeClass('has-error');
//        }else{
//            $("#phone_group").addClass('has-error');
//            console.log('invalid');
//        }
//        return isValid;
    }
</script>
